<div class="row m-3">
    <div class="col">
        <div class="mb-3">
            <label>Find Item</label>
            <div class="input-group mb-2">
                <input type="text" class="form-control" id="my_item_name" name="my_item_name" placeholder="Name" autofocus>
                <button class="btn btn-primary ml-1 mr-1" id="my_item_name_btn" onclick="searchMyItemName('')">Cari</button>
                <select name="my_item_name_select" id="my_item_name_select" class="form-control" aria-label="Default select example" required>
                    <option disabled selected value="">Select</option>
                </select>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    // $(function() {
    //     searchMyItemName('');
    // });

    function searchMyItemName(data) {
        document.getElementById('my_item_name_btn').disabled = true;
        document.getElementById('my_item_name_btn').innerHTML = "Please Wait...";
        var my_item_name = document.getElementById("my_item_name").value;

        var x = document.getElementById("my_item_name_select");
        x.innerHTML = "";
        var optiondis = document.createElement("option");
        optiondis.text = "Select";
        optiondis.disabled = true;
        optiondis.selected = true;
        x.add(optiondis);

        // if (my_item_name.length > 0) {
        var delayInMilliseconds = 2000; //2 second
        setTimeout(function() {
            $.ajax({
                url: '/finder/searchMyItemName?name=' + my_item_name,
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    var x = document.getElementById("my_item_name_select");
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

                    document.getElementById('my_item_name_btn').innerHTML = "Find";
                    document.getElementById('my_item_name_btn').disabled = false;
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    // alert('Gagal mendapatkan data');
                }
            });
        }, delayInMilliseconds);
        // }
    }
</script>
