<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>add worker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container" style="margin-top:10%">
        <div class="row">
            
            <div class="col-md-12" >
                <h2>Add workers</h2>
                @if(Session::has('success'))
                <div class="alert alert-success" role="alert">
                    {{Session::get('success')}}
                </div>
                @endif
                <form method="post" action="{{route('save-worker')}}">
                @csrf
                <div class="md-3">
                    <label class="form-label">Name</label>
                    <input type="text" class="form-control" name="name"placeholder="Enter Name" value="{{old('name')}}">
             @error('name')
                <div class="alert alert-danger" role="alert">
                    {{$message}}
                </div>
                @enderror
                </div>
                <div class="md-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" name="email"placeholder="Enter Email"  value="{{old('email')}}">
                    @error('email')
                    <div class="alert alert-danger" role="alert">
                        {{$message}}
                    </div>
                    @enderror
                    
                </div>
                <div class="md-3">
                    <label class="form-label">Phone number</label>
                    <input type="text" class="form-control" name="phone"placeholder="Enter Phone number" value="{{old('phone')}}">
                    @error('phone')
                    <div class="alert alert-danger" role="alert">
                        {{$message}}
                    </div>
                    @enderror
                    
                </div>
                <div class="md-3">
                    <label class="form-label">Address</label>
                    <textarea  class="form-control" name="address" placeholder="Enter yor address"  value="{{old('address')}}"></textarea>
                    @error('address')
                    <div class="alert alert-danger" role="alert">
                        {{$message}}
                    </div>
                    @enderror
                    
                </div>
                    <button type="submit" class="btn btn-primary mt-3">submit</button>
                    {{-- <button type="submit" class="btn btn-danger mt-3" style="float: right">Back</button> --}}
                    <a href="{{url('workers-list')}}" class="btn btn-danger mt-3" style="float: right">Back</a>



                  </form>
            </div>
        </div>
    </div>
</body>
</html>