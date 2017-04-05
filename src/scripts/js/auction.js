/**
 * Created by Saladin on 14.02.2017.
 */
$(document).ready(function () {
    var fullScreenRequest = $('.fullscreen'),
        auctionTable = $('.auction-table'),
        sellerName = auctionTable.find('.seller-name'),
        id = auctionTable.find('.id'),
        type = auctionTable.find('.type'),
        breed = auctionTable.find('.breed'),
        characteristicsDiametr = auctionTable.find('.characteristics-diametr'),
        characteristicsSort = auctionTable.find('.characteristics-sort'),
        gost = auctionTable.find('.gost'),
        characteristicsLength = auctionTable.find('.characteristics-length'),
        characteristicsStorage = auctionTable.find('.characteristics-storage'),
        size = auctionTable.find('.size'),
        customersApplied = auctionTable.find('.customers-applied'),
        costStart = auctionTable.find('.cost-start'),
        priceStart = auctionTable.find('.price-start'),
        customerNumber = auctionTable.find('.customer-number'),
        step = auctionTable.find('.step'),
        costFinal = auctionTable.find('.cost-final'),
        priceFinal = auctionTable.find('.price-final'),
        currentStep = auctionTable.find('.current-step');

    fullScreenRequest.click(function () {
        var page = document.documentElement,
            fullScreenWindow = $('#fullscreen');
        if (page.webkitRequestFullscreen) {
            page.webkitRequestFullscreen();
        } else if (page.mozRequestFullscreen) {
            page.mozRequestFullscreen();
        } else {
            page.requestFullscreen();
        }
        fullScreenWindow.fadeOut(500);
    });

    setInterval(function () {
        auctionTable.load('auction-table.php');
    }, 500);
});