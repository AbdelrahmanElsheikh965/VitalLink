@extends('admin.home')

@section('title', 'Categories Page')
@section('small-title', 'Simple title')



@section('content')
    <!-- Main content -->
    <section class="content">
        @if(session('message'))
            <div class="alert alert-success">
                <span class="closebtn" onclick="this.parentElement.style.display='none';"> &times; </span>
                {{session('message')}}
            </div>
        @endif
        @if($data->count() > 0)
        <a href="{{url(route('categories.create'))}}" class="btn btn-primary"> <li class="fa fa-plus"></li> &nbsp; Add a new one</a>
            <br> <br>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Name</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($data as $category)
                        <tr>
                            <td> {{$loop->iteration}} </td>
                            <td> {{$category->name}} </td>
                            <td> <a href="{{ route('categories.edit',[$category->id]) }}" class="btn btn-xs btn-warning fa fa-pencil"> Edit </a> </td>
                            <form action="{{ route('categories.destroy',[$category->id]) }}" method="post">
                                @csrf @method('DELETE')
                                <td> <input type="submit" onclick="return confirm('Sure ?')" value="Delete" class="btn btn-xs btn-danger fa fa-trash"> </td>
                            </form>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
        </div>

            @else
                    <div class="col-md-6">
                        <div class="box box-solid">
                            <div class="box-header with-border">
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <blockquote>
                                    <strong> 0Ops ! No Categories found.</strong> &nbsp; &nbsp;
                                    <a href="{{ url(route('categories.create')) }}" class="btn btn-primary"> <li class="fa fa-plus"></li> &nbsp; Add a new one</a>
                                </blockquote>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>

                @endif
            {{$data->links()}}
    </section>
    <!-- /.content -->
@endsection
