@extends('layouts.app')



@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>


            <form class="row gy-2 gx-3 align-items-center" method="POST" action="/shops">
            @csrf

            <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">title</label>
            <input type="text" class="form-control" name="name" id="exampleFormControlInput1" placeholder="name@example.com">
            </div>

            <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">shop lot number </label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name ="shoplot"></textarea>

            <label for="exampleFormControlTextarea1" class="form-label">floor</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="floor"></textarea>

            <div class="col-12">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>

            </div>
            </form>


            
        </div>
    </div>

    <table class="table" id="datatable" >
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">First</th>
            <th scope="col">Last</th>
            <th scope="col">Handle</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($shops as $shop)

            <tr>
            <th scope="row">1</th>
            <td>{{ $shop->name }}</td>
            </tr>

            @endforeach
        </tbody>
    </table>
</div>
@endsection
