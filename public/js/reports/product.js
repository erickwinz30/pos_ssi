function downloadPDF(filter) {
    var downloadButton = document.getElementById("downloadButton");
    var downloadText = document.getElementById("downloadText");
    var loadingSpinner = document.getElementById("loadingSpinner");
    downloadButton.disabled = true;
    downloadText.style.display = "none";
    loadingSpinner.style.display = "inline-block";

    const filters = {
        start_date: filter.startDate,
        end_date: filter.endDate,
    };

    $.ajax({
        url: "/reports/product-pdf",
        data: filters,
        method: "GET",
        xhrFields: {
            responseType: "blob", // Menetapkan respons yang diharapkan ke blob (file)
        },
        success: function (response, status, xhr) {
            // Membuat objek URL untuk blob respons
            var blobUrl = URL.createObjectURL(response);

            // Membuat elemen anchor untuk mengunduh file
            var a = document.createElement("a");
            a.href = blobUrl;
            a.download = "reports.pdf"; // Nama file yang diunduh
            document.body.appendChild(a);

            // Mengklik anchor untuk memulai unduhan
            a.click();

            // Menghapus elemen anchor setelah unduhan selesai
            document.body.removeChild(a);
        },
        error: function (xhr, status, error) {
            // Handle error jika ada
            console.error("Failed to download PDF.");
        },
        complete: function () {
            // Re-enable button and hide loading spinner
            downloadButton.disabled = false;
            downloadText.style.display = "inline-block";
            loadingSpinner.style.display = "none";
        },
    });
}
