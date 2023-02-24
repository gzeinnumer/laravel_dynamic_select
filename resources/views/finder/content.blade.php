<div class="row m-3">
    <div class="col">
        <div class="mb-3">
            <label>Find Item</label>
            <div class="input-group mb-2">
                <input type="text" class="form-control" id="myItemName_input" name="myItemName_input" placeholder="Name" autofocus>
                <button class="btn btn-primary ml-1 mr-1" id="myItemName_btn" onclick="searchMyItemName('')">Cari</button>
                <select name="myItemName_select" id="myItemName_select" class="form-control" aria-label="Default select example" required>
                    <option disabled selected value="">Select</option>
                </select>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(function() {
        searchMyItemName('');
    });

    function searchMyItemName(data) {
        document.getElementById('myItemName_btn').disabled = true;
        document.getElementById('myItemName_btn').innerHTML = "Please Wait...";
        var myItemName_input = document.getElementById("myItemName_input").value;

        var x = document.getElementById("myItemName_select");
        x.innerHTML = "";
        var optiondis = document.createElement("option");
        optiondis.text = "Select";
        optiondis.disabled = true;
        optiondis.selected = true;
        x.add(optiondis);

        var delayInMilliseconds = 2000; //2 second
        setTimeout(function() {
            searchMyItemNameAction(myItemName_input);
        }, delayInMilliseconds);
    }

    function searchMyItemNameAction() {
        $.ajax({
            url: '/finder/searchMyItemName?name=' + myItemName_input,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                var x = document.getElementById("myItemName_select");
                x.innerHTML = "";
                var optiondis = document.createElement("option");
                optiondis.text = "Select";
                optiondis.disabled = true;
                optiondis.selected = true;
                x.add(optiondis);

                for (let index = 0; index < data.length; index++) {
                    const element = data[index];

                    var option = document.createElement("option");
                    option.text = element.name;
                    option.value = element.id;
                    if (data.length == 1) {
                        option.selected = true;
                    }
                    x.add(option);
                }

                document.getElementById('myItemName_btn').innerHTML = "Find";
                document.getElementById('myItemName_btn').disabled = false;
            },
            error: function(jqXHR, textStatus, errorThrown) {
                // alert('Gagal mendapatkan data');
            }
        });
    }
</script>
