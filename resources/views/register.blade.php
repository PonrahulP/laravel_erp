<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
     crossorigin="anonymous">
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
     integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" 
     crossorigin="anonymous"></script>
     <script src="https://code.jquery.com/jquery-3.7.1.min.js" 
     integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" 
     crossorigin="anonymous"></script>
  </head>
  <style>
    input[type="text"],#role,input[type="file"]{
        border-color:black;
    }
  </style>
  <body>
  <nav class="navbar navbar-expand bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand text-light">Register Page</a>
            <a href="{{route('welcome')}}" class="navbar-brand text-light">Log In</a>
        </div>
    </nav>
    <div class="container mt-5">
        <div class="row">
            <div class="d-flex justify-content-between">
                <h5><i class="bi bi-journal-richtext"></i>Register</h5>
                <a href="{{route('welcome')}}" class="btn btn-primary"><i class="bi bi-plus-circle"></i>Log In</a>
            </div>
            <nav class="my-3">
                <ol class="breadcrumb">
                    <!-- <li class="breadcrumb-item active">Register Page</li> -->
                </ol>
            </nav><hr>
            <div class="col-md-8">
                <form action="{{route('registeruser')}}" method="POST" enctype="multipart/form-data">
                    @if(Session::has('success'))
                    <div class="alert alert-success">{{Session::get('success')}}</div>
                    @endif
                    @if(Session::has('fail'))
                    <div class="alert alert-danger">{{Session::get('fail')}}</div>
                    @endif
                    {{csrf_field()}}
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="uname" class="form-label fw-bold">Username:</label>
                            <input type="text" name="uname" id="uname" class="form-control" placeholder="Enter Username" value="{{old('uname')}}">
                            <span class="text-danger">@error('uname') {{$message}} @enderror</span>
                        </div>
                        <div class="col-md-6">
                            <label for="pwd" class="form-label fw-bold">Password:</label>
                            <input type="text" name="pwd" id="pwd" class="form-control" placeholder="Enter Password" value="{{old('pwd')}}">
                            <span class="text-danger">@error('pwd') {{$message}} @enderror</span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="mail" class="form-label fw-bold">Email Id:</label>
                            <input type="text" name="mail" id="mail" class="form-control" placeholder="Enter Email Id" value="{{old('mail')}}">
                            <span class="text-danger">@error('mail') {{$message}} @enderror</span>
                        </div>
                        <div class="col-md-6">
                            <label for="contact" class="form-label fw-bold">Contact:</label>
                            <input type="text" name="contact" id="contact" class="form-control" placeholder="Enter Contact" value="{{old('contact')}}">
                            <span class="text-danger">@error('contact') {{$message}} @enderror</span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                        <label for="contact" class="form-label fw-bold">Role:</label>
                        <select class="form-select" name="role" id="role" aria-label="Default select example" value="{{old('role')}}">
                        <option selected>Role:</option>
                        <option value="admin">Admin</option>
                        <option value="user">User</option>
                        <option value="manager">Manager</option>
                        </select>
                        <span class="text-danger">@error('role') {{$message}} @enderror</span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="bank" class="form-label fw-bold">Opening Bank Balance:</label>
                            <input type="text" name="bank" id="bank" class="form-control" placeholder="Enter Opening Bank Balance" value="{{old('bank')}}">
                            <span class="text-danger">@error('bank') {{$message}} @enderror</span>
                        </div>
                        <div class="col-md-6">
                            <label for="cash" class="form-label fw-bold">Opening Cash Balance:</label>
                            <input type="text" name="cash" id="cash" class="form-control" placeholder="Enter Opening Cash Balance" value="{{old('cash')}}">
                            <span class="text-danger">@error('cash') {{$message}} @enderror</span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="logo" class="form-label fw-bold">Logo:</label>
                            <input type="file" name="logo" id="logo" class="form-control" value="{{old('logo')}}">
                            <span class="text-danger">@error('logo') {{$message}} @enderror</span>
                        </div>
                    </div>
                    <div class="mb-3">
                        <button type="submit" name="regis" id="regis" class="btn btn-success">Register</button>
                    </div>
                    @method('GET')
</form>
</div>            
</div>
</div>
</body>
</html>