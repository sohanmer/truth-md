<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col col-md-6 col-12">
                                    <h3 class="font-weight-bolder ">Data Profiles<h3>
                                </div>
                                <div class="col">
                                    <form action="{{route('upload')}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row ml-auto">
                                            <div class="col col-md-6 col-12">
                                                <div class="form-group">
                                                    <input type="file" name= "file" class="form-control-file" id="exampleFormControlFile1">
                                                </div>
                                            </div>
                                            <div class="col col-md-6 col-12">
                                                <button type="submit" class="btn btn-primary rounded-pill">Upload</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @isset($success)
                            <div class="alert alert-success">{{$success}}</div>
                        @endisset
                        <div class="card-body table-responsive ">
                            <div class="row">
                                <h5 class="p-4 font-weight-bolder">Total License: {{$count}}</h5>
                            </div>
                            
                            <table class="table table-sm" id="table_id" class="display">
                                <thead class="bg-info">
                                  <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">License</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Progress</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @foreach($dataProfiles as $dataProfile)
                                        <tr>
                                            <th scope="row">{{$dataProfile->id}}</th>
                                            <td>{{$dataProfile->license}}</td>
                                            @if($dataProfile->name == null)
                                                <td>--</td>
                                            @else
                                                <td>{{$dataProfile->name}}</td>
                                            @endif
                                            @if($dataProfile->address == null)
                                                <td>--</td>
                                            @else
                                                <td>{{$dataProfile->address}}</td>
                                            @endif
                                            @if($dataProfile->phone == null)
                                                <td>--</td>
                                            @else
                                                <td>{{$dataProfile->phone}}</td>
                                            @endif
                                            @if($dataProfile->in_progress == null)
                                                <td>--</td>
                                            @else
                                                <td>{{$dataProfile->in_progress}}</td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class=" row justify-content-md-center">
                                {{ $dataProfiles->links() }}
                            </div>                  
                        </div>
                    </div>
                </div>
            </div>
        </div>
            </body>
</html>
