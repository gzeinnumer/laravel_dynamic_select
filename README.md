# laravel_dynamic_select

![](/preview/preview1.png)

```php
Route::prefix('finder')->group(function () {
    Route::get('/', [FinderController::class, 'index']);
    Route::get('/myItemNameSearch', [FinderController::class, 'myItemNameSearch']);
});
```

```php
<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FinderController extends Controller
{
    function index()
    {
        return view('finder.index');
    }

    function myItemNameSearch(Request $r)
    {
        $data = User::select();
        $name = urldecode($r->name);
        if ($name != "") {
            $data = $data->where('name', 'LIKE', '%' . $name . '%');
        }
        $data = $data->get();

        return $data;
    }
}
```

```html
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <title>Document</title>
        <link
            rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
            integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
            crossorigin="anonymous"
        />
        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"
            integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
            crossorigin="anonymous"
        ></script>
        <script
            src="https://code.jquery.com/jquery-3.3.1.js"
            integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
            crossorigin="anonymous"
        ></script>
    </head>

    <body>
        @include('finder.content')
    </body>
</html>
```

```html
<div class="row m-3">
    <div class="col">
        <div class="mb-3">
            <label>Find Item</label>
            <div class="input-group mb-2">
                <input
                    type="text"
                    class="form-control"
                    id="myItemName_input"
                    name="myItemName_input"
                    placeholder="Name"
                    autofocus
                />
                <button
                    class="btn btn-primary ml-1 mr-1"
                    id="myItemName_btn"
                    onclick="myItemNameSearch('')"
                >
                    Cari
                </button>
                <button class="btn btn-primary ml-1 mr-1" id="myItemName_count">
                    0 Data
                </button>
                <select
                    name="myItemName_select"
                    id="myItemName_select"
                    class="form-control"
                    aria-label="Default select example"
                    required
                >
                    <option disabled selected value="">Select</option>
                </select>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function () {
        myItemNameSearch("");
    });

    function myItemNameSearch(data) {
        document.getElementById("myItemName_btn").disabled = true;
        document.getElementById("myItemName_btn").innerHTML = "Please Wait...";
        document.getElementById("myItemName_count").innerHTML = "0 Data";
        var myItemName_input =
            document.getElementById("myItemName_input").value;

        var x = document.getElementById("myItemName_select");
        x.innerHTML = "";
        var optiondis = document.createElement("option");
        optiondis.text = "Select";
        optiondis.disabled = true;
        optiondis.selected = true;
        x.add(optiondis);

        var delayInMilliseconds = 2000; //2 second
        setTimeout(function () {
            myItemNameSearchAction(myItemName_input);
        }, delayInMilliseconds);
    }

    function myItemNameSearchAction(myItemName_input) {
        $.ajax({
            url: "/finder/myItemNameSearch?name=" + myItemName_input,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
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

                document.getElementById("myItemName_btn").innerHTML = "Find";
                document.getElementById("myItemName_count").innerHTML =
                    data.length + " Data";
                document.getElementById("myItemName_btn").disabled = false;
            },
            error: function (jqXHR, textStatus, errorThrown) {
                // alert('Gagal mendapatkan data');
            },
        });
    }
</script>
```

---

```
Copyright 2022 M. Fadli Zein
```
