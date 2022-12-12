<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>workers-list</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
   
   
    <div class="container" style="margin-top:10%">
        <div class="row">
            <div class="col-md-12" >
                <h2>zodja Tech workers list</h2>
                <div style="float:right;">
                    <a href="{{url('add-worker')}}" class="btn btn-primary">Add workers</a>
                </div>
                @if(Session::has('success'))
                <div class="alert alert-success" role="alert">
                    {{Session::get('success')}}
                </div>
                @endif
                <table class="table">
                    <thead><tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Adderes</th>
                        <th>Action</th>



                    </tr></thead>
                    <tbody>
                        @php
                        $i=1;
                        @endphp
                        @foreach ($data as $work)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$work->name}}</td>
                            <td>{{$work->email}}</td>
                            <td>{{$work->phone}}</td>
                            <td>{{$work->address}}</td>
                             <td><a href="{{url('edit-worker/' . $work->id)}}" 
                             class="btn btn-primary">Edit</a></td>
                             <td><a href="{{url('delete-worker/' . $work->id)}}"  class="btn btn-danger">Delete</a></td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
   
   
</body>
</html>