//Applicant start
$(document).ready( function () {
    $('#printable-table').DataTable();
} );

$('#printable-table').DataTable( {
    select: true
} );

var myTable1 = new function () {
    this.printApplicantTable = function () {
        var table = document.getElementById('printable-table');
        var style = "<style>";
        style = style + "table {width: 100%;font: 12px Calibri;}";
        style = style + "table, th, td {border: solid 1px #DDD; border-collapse: collapse;";
        style = style + "padding: 2px 3px;text-align: center;}";
        style = style + "</style>";

        var win = window.open('', '', 'height=700,width=700');
        win.document.write(style);
        win.document.write(table.outerHTML);
        win.document.close();
        win.print();
    }
}
//Applicant End

//Pre-qualified start
$(document).ready( function () {
    $('#printable-table-pre').DataTable();
} );

$('#printable-table-pre').DataTable( {
    select: true
} );

var myTable2 = new function () {
    this.printPreQualifiedTable = function () {
        var table = document.getElementById('printable-table');
        var style = "<style>";
        style = style + "table {width: 100%;font: 12px Calibri;}";
        style = style + "table, th, td {border: solid 1px #DDD; border-collapse: collapse;";
        style = style + "padding: 2px 3px;text-align: center;}";
        style = style + "</style>";

        var win = window.open('', '', 'height=700,width=700');
        win.document.write(style);
        win.document.write(table.outerHTML);
        win.document.close();
        win.print();
    }
}
//Pre-qualified end

//Qualified start
$(document).ready( function () {
    $('#printable-table-qual').DataTable();
} );

$('#printable-table-qual').DataTable( {
    select: true
} );

var myTable3 = new function () {
    this.printQualifiedTable = function () {
        var table = document.getElementById('printable-table');
        var style = "<style>";
        style = style + "table {width: 100%;font: 12px Calibri;}";
        style = style + "table, th, td {border: solid 1px #DDD; border-collapse: collapse;";
        style = style + "padding: 2px 3px;text-align: center;}";
        style = style + "</style>";

        var win = window.open('', '', 'height=700,width=700');
        win.document.write(style);
        win.document.write(table.outerHTML);
        win.document.close();
        win.print();
    }
}
//Qualified end

//Rejected start
$(document).ready( function () {
    $('#printable-table-rej').DataTable();
} );

$('#printable-table-rej').DataTable( {
    select: true
} );

var myTable4 = new function () {
    this.printRejectedTable = function () {
        var table = document.getElementById('printable-table');
        var style = "<style>";
        style = style + "table {width: 100%;font: 12px Calibri;}";
        style = style + "table, th, td {border: solid 1px #DDD; border-collapse: collapse;";
        style = style + "padding: 2px 3px;text-align: center;}";
        style = style + "</style>";

        var win = window.open('', '', 'height=700,width=700');
        win.document.write(style);
        win.document.write(table.outerHTML);
        win.document.close();
        win.print();
    }
}
//Rejected end