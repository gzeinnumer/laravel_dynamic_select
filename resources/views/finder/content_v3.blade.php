<div class="row m-3">
    <div class="col">
        <div class="mb-3">
            <label>Find Item</label>
            <div class="input-group mb-2">
                <input type="text" class="form-control" id="myItemNameV3_input_V3" onkeyup="myItemNameV3Search('')"placeholder="Name Product" autofocus>
                <button class="btn btn-primary ml-1 mr-1" id="myItemNameV3_count">8 Data</button>
                <select name="myItemNameV3_select" id="myItemNameV3_select" class="form-control" aria-label="Default select example" required>
                    <option disabled selected value="">Select</option>
                    <option value="1">HVS - 70 GSM - A5 - Cyan - 10000</option>
                    <option value="1">HVS - 100 GSM - A5 - Cyan - 20000</option>
                    <option value="1">HVS - 210 GSM - A5 - Cyan - 30000</option>
                    <option value="1">HVS - 230 GSM - A5 - Cyan - 40000</option>
                    <option value="1">HVS - NCR GSM - A5 - Cyan - 50000</option>
                    <option value="1">CONCORDE - 70 GSM - A5 - Cyan - 10000</option>
                    <option value="1">CONCORDE - 100 GSM - A5 - Cyan - 20000</option>
                    <option value="1">CONCORDE - 210 GSM - A5 - Cyan - 30000</option>
                    <option value="1">CONCORDE - 230 GSM - A5 - Cyan - 40000</option>
                    <option value="1">CONCORDE - NCR GSM - A5 - Cyan - 50000</option>
                </select>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    function myItemNameV3Search(data) {
        var input, filter, ul, li, a, i;
        input = document.getElementById("myItemNameV3_input_V3");
        filter = input.value.toUpperCase();
        div = document.getElementById("myItemNameV3_select");
        a = div.getElementsByTagName("option");
        var count = 0;
        var selectedValue = "";
        for (i = 0; i < a.length; i++) {
            txtValue = a[i].textContent || a[i].innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                a[i].style.display = "";
                count++;
                if (count == 1) {
                    selectedValue = a[i].value;
                }
            } else {
                a[i].style.display = "none";
            }
        }
        if (count == 1) {
            document.getElementById("myItemNameV3_select").value = selectedValue;
        } else {
            document.getElementById("myItemNameV3_select").value = "";
        }
        if (input.value.length == 0) {
            count = count - 1;
        }
        document.getElementById('myItemNameV3_count').innerHTML = count + " Data";
    }
</script>
