# laravel_dynamic_select

![](/preview/preview1.png)

```php
Route::prefix('finder')->group(function () {
    Route::get('/', [FinderController::class, 'index']);
    Route::get('/searchMyItemName', [FinderController::class, 'searchMyItemName']);
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

    function searchMyItemName(Request $r)
    {
        $data = User::select();

        if (urldecode($r->name) != "") {
            $data = $data->where('name', 'LIKE', '%' . urldecode($r->name) . '%');
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
                    id="my_item_name"
                    name="my_item_name"
                    placeholder="Name"
                    oninvalid="searchMyItemName('')"
                    onkeyup="searchMyItemName('')"
                    onchange="searchMyItemName('')"
                    autofocus
                />
                <select
                    name="my_item_name_select"
                    id="my_item_name_select"
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
        searchMyItemName("");
    });

    function searchMyItemName(data) {
        var my_item_name = document.getElementById("my_item_name").value;
        if (my_item_name.length > 0) {
            $.ajax({
                url: "/finder/searchMyItemName?name=" + my_item_name,
                type: "GET",
                dataType: "JSON",
                success: function (data) {
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
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    // alert('Gagal mendapatkan data');
                },
            });
        } else {
            var x = document.getElementById("my_item_name_select");
            x.innerHTML = "";
            var optiondis = document.createElement("option");
            optiondis.text = "Select";
            optiondis.disabled = true;
            optiondis.selected = true;
            x.add(optiondis);
        }
    }
</script>
```

---

```
Copyright 2022 M. Fadli Zein
```
