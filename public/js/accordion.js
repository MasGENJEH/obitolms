$(() => {
    $("[data-expand]").on("click", function (e) {
        // Toggle slide on the clicked element
        $(this).children("img").toggleClass("-rotate-180");
        let target = $(`#${$(this).data("expand")}`);
        target.slideToggle();

        // Close other accordion items
        $("[data-expand]").not(this).each(function () {
            $(this).children("img").addClass("-rotate-180");
            let otherTarget = $(`#${$(this).data("expand")}`);
            otherTarget.slideUp();
        });
    });
});
