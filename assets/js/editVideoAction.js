function setNewThumbnail(thumbnailId, videoId, itemElement) {
    $.post("ajax/updateThumbnail.php", {thumbnailId: thumbnailId, videoId: videoId})
    .done(function(data) {
        // console.log(data);

        var item = $(itemElement);
        var itemClass = item.attr("class");

        $("." + itemClass).removeClass("selected");

        item.addClass("selected");
        alert("Thumbnail Updated");
    });
}