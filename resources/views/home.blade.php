<html>

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-dark">
        <a class="navbar-brand  text-white" href="#">هويتي</a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav pl-5 ml-5">
                <li class="nav-item ">
                    <a class=" btn btn text-white" href="{{ route('cardFound') }}">الطلبات</a>
                </li>
                <li class="nav-item ">
                    <a class="btn btn  text-white" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                                                             document.getElementById('logout-form').submit();">
                        {{ __('تسجيل خروج') }}
                    </a>
                </li>
            </ul>

            <form class="form-inline my-2 my-lg-0" id="logout-form" action="{{ route('logout') }}" method="POST"
                class="d-none">
                @csrf
            </form>
        </div>
    </nav>
    <div class="container mt-5">

        <div class="card">
            <div class="card-header bg-dark text-white text-center">
                <h2 class="mb-4">جدول الهويات المفقودة</h2>

            </div>
            <div class="card-body">
                <table class="table table-hover yajra-datatable">
                    <thead class="thead-dark">
                        <tr>

                            <th>اسم البطاقة </th>
                            <th>اسم المستخدم </th>
                            <th>عنوان المستخدم</th>
                            <th>رقم هاتف المستخدم</th>
                            <th>الصورة </th>

                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

<style>
    .navbar-nav {
        margin-left: 1300px !important;
    }

    img {
        transition: transform 0.25s ease;
    }

    img:hover {
        -webkit-transform: scale(5.5);
        transform: scale(5.5);
    }

</style>
<script type="text/javascript">
    $(function() {

        var table = $('.yajra-datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('get.cards') }}",
            columns: [{
                    data: 'card_name',
                    name: 'card_name'
                },
                {
                    data: 'user.full_name',
                    name: 'user.full_name'
                },
                {
                    data: 'address',
                    name: 'address'
                },
                {
                    data: 'phone_number',
                    name: 'phone_number'
                },
                {
                    data: 'image',
                    name: 'image'
                },

            ]
        });

    });
</script>

</html>
