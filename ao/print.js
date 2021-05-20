//Pre qual Applicant start
$(document).ready( function () {
    $('#printable_ao_pre_table').DataTable();
} );

$('#printable_ao_pre_table').DataTable( {
    select: true
} );

var myTable1 = new function () {
    this.printPre_ApplicantTable = function () {
        var table = document.getElementById('printable_ao_pre_table');
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
//Pre-qual Applicant End

//qualified start
$(document).ready( function () {
    $('#printable_ao_qual_table').DataTable();
} );

$('#printable_ao_qual_table').DataTable( {
    select: true
} );

var myTable2 = new function () {
    this.printQual_ApplicantTable = function () {
        var table = document.getElementById('printable_ao_qual_table');
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
//qualified end
