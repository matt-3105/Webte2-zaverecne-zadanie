$(document).ready(function() {
    var specialElementHandlers = {
        "#editor": function (element, rendrer) {
            return true;
        }
    };

    $('#click-button').click(function () {

        var myDocument = new jsPDF();

        myDocument.fromHTML($("#target").html(), 15, 15, {
            "width": 170,
            "elementHandlers": specialElementHandlers
        });

        myDocument.save("File.pdf");
    });
})