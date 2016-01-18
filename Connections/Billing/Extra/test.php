<html>

    <head>
        <title> Add/Remove dynamic rows in HTML table </title>
        <script language="javascript">

            function addRow(tableID) {
                var numb = document.getElementById("numb").value;
                for($i=1;$i<=numb;$i++) {
                    var table = document.getElementById(tableID);

                    var rowCount = table.rows.length;
                    var row = table.insertRow(rowCount);

                    var cell1 = row.insertCell(0);
                    var element1 = document.createElement("input");
                    element1.type = "checkbox";
                    cell1.appendChild(element1)[$i];

                    var cell2 = row.insertCell(1);
                    cell2.innerHTML = rowCount + 1;

                    var cell3 = row.insertCell(2);
                    var element2 = document.createElement("input");
                    element2.type = "text";
                    element2.name = "firstname["+rowCount+"]";
                    cell3.appendChild(element2)[$i];	

                    var cell4 = row.insertCell(3);
                    var element3 = document.createElement("input");
                    element3.type = "text";
                    element3.name = "lastname["+rowCount+"]";
                    cell4.appendChild(element3)[$i];

                    var cell5 = row.insertCell(3);
                    var element4 = document.createElement("input");
                    element4.type = "text";
                    element4.name = "town["+rowCount+"]";
                    cell5.appendChild(element4)[$i];

                    var cell6 = row.insertCell(3);
                    var element5 = document.createElement("input");
                    element5.type = "text";
                    element5.name = "state["+rowCount+"]";
                    cell6.appendChild(element5)[$i];
                }

            }
        </script>
    </head>
    <body>
     <form action="test.php" method="post">
        <input type="button" value="Add Row" onclick="addRow('dataTable')" />
        <input type="text" name="numb" id="numb" value="" />
        <input type="submit" name="submit" value="submit" />
        <table id="dataTable" width="350px" border="1">

        </table>
        </form>
    </body>
    </html>