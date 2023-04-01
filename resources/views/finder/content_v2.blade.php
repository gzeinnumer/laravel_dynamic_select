<div class="row m-3">
    <div class="col">
        <div class="mb-3">
            <label>Find Item</label>
            <div class="input-group mb-2">
                <input type="text" class="form-control" id="myItemNameV2_input_v2" onkeyup="myItemNameV2Search('')"placeholder="Name V2" autofocus>
                <button class="btn btn-primary ml-1 mr-1" id="myItemNameV2_count">0 Data</button>
                <select name="myItemNameV2_select" id="myItemNameV2_select" class="form-control" aria-label="Default select example" required>
                    <option disabled selected value="">Select</option>
                </select>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(function() {
        myItemNameV2Load('');
    });

    function myItemNameV2Load(data) {
        document.getElementById('myItemNameV2_count').innerHTML = "0 Data";
        var myItemNameV2_input_v2 = document.getElementById("myItemNameV2_input_v2").value;

        var x = document.getElementById("myItemNameV2_select");
        x.innerHTML = "";
        var optiondis = document.createElement("option");
        optiondis.text = "Select";
        optiondis.disabled = true;
        optiondis.selected = true;
        x.add(optiondis);

        $.ajax({
            url: '/finder/myItemNameV2Search?name=' + myItemNameV2_input_v2,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                var x = document.getElementById("myItemNameV2_select");
                x.innerHTML = "";
                var optiondis = document.createElement("option");
                optiondis.text = "Select";
                optiondis.disabled = true;
                optiondis.selected = true;
                x.add(optiondis);

                for (let index = 0; index < data.length; index++) {
                    const element = data[index];

                    var option = document.createElement("option");
                    option.text = element.name + " - " + element.email;
                    option.value = element.id;
                    if (data.length == 1) {
                        option.selected = true;
                    }
                    x.add(option);
                }

                document.getElementById('myItemNameV2_count').innerHTML = data.length + " Data";
            },
            error: function(jqXHR, textStatus, errorThrown) {
                // alert('Gagal mendapatkan data');
            }
        });
    }

    function myItemNameV2Search(data) {
        var input, filter, ul, li, a, i;
        input = document.getElementById("myItemNameV2_input_v2");
        filter = input.value.toUpperCase();
        div = document.getElementById("myItemNameV2_select");
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
            document.getElementById("myItemNameV2_select").value = selectedValue;
        } else {
            document.getElementById("myItemNameV2_select").value = "";
        }
        if (input.value.length == 0) {
            count = count - 1;
        }
        document.getElementById('myItemNameV2_count').innerHTML = count + " Data";
    }
</script>
