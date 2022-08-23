<?php
include "simple_html_dom.php";
$table = '<table border="1">
<tr>
<th>Header 1</th>
<th>Header 2</th>
</tr>
<tr>
<td>row 1, cell 1</td>
<td>row 1, cell 2</td>
</tr>
<tr>
<td>row 2, cell 1</td>
<td>row 2, cell 2</td>
</tr>
</table>';

$html = str_get_html($table);

$fileName = "export.csv";
header('Content-type: application/ms-excel');
header("Content-Disposition: attachment; filename=$fileName");

$fp = fopen("php://output", "w");
$csvString = "";

$html = str_get_html(trim($table));
foreach ($html->find('tr') as $element) {

    $td = array();
    foreach ($element->find('th') as $row) {
        $row->plaintext = "\"$row->plaintext\"";
        $td[] = $row->plaintext;
    }
    $td = array_filter($td);
    $csvString .= implode(",", $td);

    $td = array();
    foreach ($element->find('td') as $row) {
        $row->plaintext = "\"$row->plaintext\"";
        $td[] = $row->plaintext;
    }
    $td = array_filter($td);
    $csvString .= implode(",", $td) . "\n";
}
echo $csvString;
fclose($fp);
exit;
