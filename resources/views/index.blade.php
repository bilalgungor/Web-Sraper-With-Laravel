<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Web</title>


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <style>
        body,
        html {
            height: 100%;
        }
    </style>
</head>

<body>
    <div class="container h-100">
        <div class="row h-50 justify-content-center align-items-center mt-5">
            <form action="{{ route('crawler.post') }}" method="POST" class="col-12">
                @csrf
                <div class="form-group">
                    <label for="url">Url</label>
                    <input type="text" class="form-control" id="url" name="url" placeholder="Url" value="{{ request()->input('url') }}">
                    <small id="url" class="form-text text-muted">Website</small>
                </div>
                <div class="form-group">
                    <label for="page">Page Number</label>
                    <input type="number" class="form-control" id="page" name="page" placeholder="Page Number" value="{{ request()->input('page') }}">
                    <small id="page" class="form-text text-muted">If Website Include Pagination</small>
                </div>
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Title" value="{{ request()->input('title') }}">
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="text" class="form-control" id="price" name="price" placeholder="Price" value="{{ request()->input('price') }}">
                </div>
                <div class="form-group">
                    <label for="filter">Filter</label>
                    <input type="text" class="form-control" id="filter" name="filter" placeholder="Filter" value="{{ request()->input('filter') }}">
                </div>
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">Send</button>
                    <button type="submit" name="excel" class="btn btn-primary">Excel Export</button>
                </div>
            </form>

            <div class="col-12 mt-5">
                <table class="table" id="dataTable">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Product</th>
                            <th scope="col">Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @isset ($arr)
                        <?php $i = 1; ?>
                        @foreach($arr as $value)
                        <tr>
                            <th scope="row">{{ $i++ }}</th>
                            <td>{{ $value['title'] }}</td>
                            <td>{{ $value['price'] }}</td>
                        </tr>
                        @endforeach
                        @endisset
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready( function () {
    $('#dataTable').DataTable();
        } );
    </script>
</body>

</html>
