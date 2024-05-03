async function loadDatabase() {
    const db = await idb.openDB("tailwind_store", 1, {
        upgrade(db, oldVersion, newVersion, transaction) {
            db.createObjectStore("products", {
                keyPath: "id",
                autoIncrement: true,
            });
            db.createObjectStore("sales", {
                keyPath: "id",
                autoIncrement: true,
            });
        },
    });

    return {
        db,
        getProducts: async () => await db.getAll("products"),
        addProduct: async (product) => await db.add("products", product),
        editProduct: async (product) =>
            await db.put("products", product.id, product),
        deleteProduct: async (product) =>
            await db.delete("products", product.id),
    };
}
function initApp() {
    const app = {
        db: null,
        time: null,
        firstTime: localStorage.getItem("first_time") === null,
        activeMenu: "pos",
        loadingSampleData: false,
        moneys: [2000, 5000, 10000, 20000, 50000, 100000],
        products: [],
        keyword: "",
        cart: [],
        cash: 0,
        change: 0,
        isShowModalReceipt: false,
        isShowModalEndSession: false,
        isShowModalQr: false,
        qr: null,
        qr_id: null,
        receiptNo: null,
        receiptDate: null,
        async initDatabase() {
            this.db = await loadDatabase();
            this.loadProducts();
        },
        async loadProducts() {
            this.products = await this.db.getProducts();
            console.log("products loaded", this.products);
        },
        async startWithSampleData() {
            const response = await fetch("data/sample.json");
            const data = await response.json();
            this.products = data.products;
            for (let product of data.products) {
                await this.db.addProduct(product);
            }

            this.setFirstTime(false);
        },
        startBlank() {
            this.setFirstTime(false);
        },
        setFirstTime(firstTime) {
            this.firstTime = firstTime;
            if (firstTime) {
                localStorage.removeItem("first_time");
            } else {
                localStorage.setItem("first_time", new Date().getTime());
            }
        },
        filteredProducts() {
            const rg = this.keyword ? new RegExp(this.keyword, "gi") : null;
            return this.products.filter((p) => !rg || p.name.match(rg));
        },
        addToCart(product, imgProduct) {
            const index = this.findCartIndex(product);
            if (index === -1) {
                this.cart.push({
                    productId: product.id,
                    name: product.name,
                    image: imgProduct,
                    price: parseInt(product.price),
                    qty: 1,
                });
            } else {
                this.cart[index].qty += 1;
            }
            this.updateChange();
        },
        findCartIndex(product) {
            return this.cart.findIndex((p) => p.productId === product.id);
        },
        addQty(item, qty) {
            const index = this.cart.findIndex(
                (i) => i.productId === item.productId
            );
            if (index === -1) {
                return;
            }
            const afterAdd = item.qty + qty;
            if (afterAdd === 0) {
                this.cart.splice(index, 1);
            } else {
                this.cart[index].qty = afterAdd;
            }
            this.updateChange();
        },
        addCash(amount) {
            this.cash = (this.cash || 0) + amount;
            // document.getElementById('pay_amount').value = this.cash;
            this.updateChange();
        },
        getItemsCount() {
            return this.cart.reduce((count, item) => count + item.qty, 0);
        },
        updateChange() {
            this.change = this.cash - this.getTotalPrice();
            // document.getElementById('change').value = this.change;
        },
        updateCash(value) {
            this.cash = parseFloat(value.replace(/[^0-9]+/g, ""));
            this.updateChange();
        },
        getTotalPrice() {
            var totalPrice = this.cart.reduce(
                (total, item) => total + item.qty * item.price,
                0
            );

            // document.getElementById('total_amount').value = totalPrice;
            return totalPrice;
        },
        submitable() {
            return this.change >= 0 && this.cart.length > 0;
        },
        endSession() {
            this.isShowModalEndSession = true;
        },
        closeModalEndSession() {
            this.isShowModalEndSession = false;
        },
        processEndSession() {
            const csrfToken = document.head.querySelector(
                'meta[name="csrf-token"]'
            ).content;
            const ending_cash_system = document
                .getElementById("ending_cash_system")
                .value.replace("Rp. ", "")
                .replace(".", "");
            const ending_cash_actual = document
                .getElementById("ending_cash_actual")
                .value.replace("Rp. ", "")
                .replace(".", "");

            const formData = new FormData();
            formData.append(
                "session_id",
                document.getElementById("sesion_id").value
            );
            formData.append("ending_cash_system", parseInt(ending_cash_system));
            formData.append("ending_cash_actual", parseInt(ending_cash_system));

            $.ajax({
                type: "POST",
                url: "/point-of-sales/end-session",
                data: formData,
                headers: {
                    "X-CSRF-TOKEN": csrfToken,
                },
                processData: false,
                contentType: false,
                success: function (data) {
                    Swal.fire({
                        title: "End Session Success!",
                        icon: "success",
                        confirmButtonText: "Ok",
                    }).then(() => {
                        window.location.href = "/pos-session";
                    });
                },
                error: function (xhr, status, error) {
                    console.error(error);
                },
            });
        },
        submit() {
            const time = new Date();
            this.isShowModalReceipt = true;
            this.receiptNo = `TWPOS-KS-${Math.round(time.getTime() / 1000)}`;
            this.receiptDate = this.dateFormat(time);
        },
        closeModalReceipt() {
            this.isShowModalReceipt = false;
        },
        dateFormat(date) {
            const formatter = new Intl.DateTimeFormat("id", {
                dateStyle: "short",
                timeStyle: "short",
            });
            return formatter.format(date);
        },
        numberFormat(number) {
            return (number || "")
                .toString()
                .replace(/^0|\./g, "")
                .replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
        },
        priceFormat(number) {
            return number ? `Rp. ${this.numberFormat(number)}` : `Rp. 0`;
        },
        clear() {
            this.cash = 0;
            this.cart = [];
            this.receiptNo = null;
            this.receiptDate = null;
            this.updateChange();
        },
        searchProducts() {
            const params = new URLSearchParams();
            params.append("q", this.keyword);
            const url = "/point-of-sales" + "?" + params.toString();
            window.location.href = url;
        },
        async cekQrisPayment() {
            try {
                const qr_id = this.qr_id;
                const csrfToken = document.head.querySelector(
                    'meta[name="csrf-token"]'
                ).content;
                return new Promise((resolve, reject) => {
                    $.ajax({
                        type: "GET",
                        url: "/qris?qr_id=" + qr_id,
                        headers: {
                            "X-CSRF-TOKEN": csrfToken,
                        },
                        processData: false,
                        contentType: false,
                        success: function (data) {
                            resolve(data.data);
                        },
                        error: function (xhr, status, error) {
                            reject(error);
                        },
                    });
                });
            } catch (error) {
                return false;
            }
        },
        async cekQrisPaid(
            session_id,
            total_amount,
            pay_amount,
            changes,
            payment_method
        ) {
            let response = true;

            if (this.isShowModalQr) {
                response = await this.cekQrisPayment();
            } else {
                return;
            }

            if (!response) {
                await new Promise((resolve) => setTimeout(resolve, 2000));
                await this.cekQrisPaid(
                    session_id,
                    total_amount,
                    pay_amount,
                    changes,
                    payment_method
                );
            } else {
                const csrfToken = document.head.querySelector(
                    'meta[name="csrf-token"]'
                ).content;

                const formData = new FormData();
                formData.append("session_id", session_id);
                formData.append("total_amount", total_amount);
                formData.append("pay_amount", pay_amount);
                formData.append("changes", changes);
                formData.append("payment_method", payment_method);

                this.cart.forEach((item, index) => {
                    formData.append(
                        `cart[${index}][productId]`,
                        item.productId
                    );
                    formData.append(`cart[${index}][name]`, item.name);
                    formData.append(`cart[${index}][price]`, item.price);
                    formData.append(`cart[${index}][qty]`, item.qty);
                });

                $.ajax({
                    type: "POST",
                    url: "/point-of-sales/store",
                    data: formData,
                    headers: {
                        "X-CSRF-TOKEN": csrfToken,
                    },
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        Swal.fire({
                            title: "Payment QRIS Paid!",
                            icon: "success",
                            confirmButtonText: "Ok",
                        }).then(() => {
                            window.location.reload(true);
                        });
                    },
                    error: function (xhr, status, error) {
                        console.error(error);
                    },
                });
            }
        },
        generateQris(
            session_id,
            total_amount,
            pay_amount,
            changes,
            payment_method
        ) {
            this.isShowModalReceipt = false;
            const csrfToken = document.head.querySelector(
                'meta[name="csrf-token"]'
            ).content;

            const formData = new FormData();
            formData.append("amount", total_amount);

            var self = this;

            $.ajax({
                type: "POST",
                url: "/qris",
                data: formData,
                headers: {
                    "X-CSRF-TOKEN": csrfToken,
                },
                processData: false,
                contentType: false,
                success: function (data) {
                    self.qr = data.data.qr_string;
                    self.qr_id = data.data.id;

                    self.isShowModalQr = true;

                    new QRCode(document.getElementById("qrcode"), self.qr);

                    self.cekQrisPaid(
                        session_id,
                        total_amount,
                        pay_amount,
                        changes,
                        payment_method
                    );
                },
                error: function (xhr, status, error) {
                    console.error(error);
                },
            });
        },
        printAndProceed() {
            const payment_method =
                document.getElementById("payment_method").value;
            const session_id = document.getElementById("sesion_id").value;
            const total_amount = this.getTotalPrice();
            const pay_amount = this.cash;
            const changes = this.change;

            if (payment_method === "Non Tunai") {
                this.generateQris(
                    session_id,
                    total_amount,
                    total_amount,
                    0,
                    payment_method
                );
            } else {
                const csrfToken = document.head.querySelector(
                    'meta[name="csrf-token"]'
                ).content;

                const formData = new FormData();
                formData.append("session_id", session_id);
                formData.append("total_amount", total_amount);
                formData.append("pay_amount", pay_amount);
                formData.append("changes", changes);
                formData.append("payment_method", payment_method);

                this.cart.forEach((item, index) => {
                    formData.append(
                        `cart[${index}][productId]`,
                        item.productId
                    );
                    formData.append(`cart[${index}][name]`, item.name);
                    formData.append(`cart[${index}][price]`, item.price);
                    formData.append(`cart[${index}][qty]`, item.qty);
                });

                $.ajax({
                    type: "POST",
                    url: "/point-of-sales/store",
                    data: formData,
                    headers: {
                        "X-CSRF-TOKEN": csrfToken,
                    },
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        Swal.fire({
                            title: "Data Stored!",
                            icon: "success",
                            confirmButtonText: "Ok",
                        }).then(() => {
                            window.location.reload(true);
                        });
                    },
                    error: function (xhr, status, error) {
                        console.error(error);
                    },
                });
            }
        },
    };

    return app;
}
