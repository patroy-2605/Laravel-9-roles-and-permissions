{{--  @extends('layouts.app')
  --}}

{{--  @section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Products</h2>
            </div>
            <div class="pull-right">
                @can('product-create')
                <a class="btn btn-success" href="{{ route('products.create') }}"> Create New Product</a>
                @endcan
            </div>
        </div>
    </div>


    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif


    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Details</th>
            <th width="280px">Action</th>
        </tr>
	    @foreach ($products as $product)
	    <tr>
	        <td>{{ ++$i }}</td>
	        <td>{{ $product->name }}</td>
	        <td>{{ $product->detail }}</td>
	        <td>
                <form action="{{ route('products.destroy',$product->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('products.show',$product->id) }}">Show</a>
                    @can('product-edit')
                    <a class="btn btn-primary" href="{{ route('products.edit',$product->id) }}">Edit</a>
                    @endcan


                    @csrf
                    @method('DELETE')
                    @can('product-delete')
                    <button type="submit" class="btn btn-danger">Delete</button>
                    @endcan
                </form>
	        </td>
	    </tr>
	    @endforeach
    </table>


    {!! $products->links() !!}


<p class="text-center text-primary"><small>Tutorial by ItSolutionStuff.com</small></p>
@endsection  --}}

@extends('layouts.app')
{{--  @section('page_title', 'Student Information - '.$my_class->name)  --}}
@section('page_title', 'Student Information - ')
@section('content')

    <div class="card">
        <div class="card-header header-elements-inline">
            <h6 class="card-title">Students List</h6>
            {{--  {!! Qs::getPanelOptions() !!}  --}}
        </div>

        <div class="card-body">
            <ul class="nav nav-tabs nav-tabs-highlight">
                {{--  <li class="nav-item"><a href="#all-students" class="nav-link active" data-toggle="tab">All {{ $my_class->name }} Students</a></li>  --}}
                <li class="nav-item"><a href="#all-students" class="nav-link active" data-toggle="tab">All Prospects</a></li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Sections</a>
                    <div class="dropdown-menu dropdown-menu-right">
                        @foreach($products as $product)
                            {{--  <a href="#s{{ $product->id }}" class="dropdown-item" data-toggle="tab">{{ $my_class->name.' '.$product->name }}</a>  --}}
                            <a href="#s{{ $product->id }}" class="dropdown-item" data-toggle="tab">{{ $product->name }}</a>
                        @endforeach
                    </div>
                </li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane fade show active" id="all-students">
                    <table class="table datatable-button-html5-columns">
                        <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Name</th>
                            <th>Detail</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                {{--  <td><img class="rounded-circle" style="height: 40px; width: 40px;" src="{{ $product->photo }}" alt="photo"></td>  --}}
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->detail }}</td>
                                <td class="text-center">
                                    <div class="list-icons">
                                        <div class="dropdown">
                                            <a href="#" class="list-icons-item" data-toggle="dropdown">
                                                <i class="icon-menu9"></i>
                                            </a>

                                            <div class="dropdown-menu dropdown-menu-left">

                                                    <form action="{{ route('products.destroy',$product->id) }}" method="POST">
                                                        <a class="dropdown-item" href="{{ route('products.show',$product->id) }}"><i class="icon-eye"></i>Show</a>
                                                        @can('product-edit')
                                                        <a class="dropdown-item" href="{{ route('products.edit',$product->id) }}"><i class="icon-pencil">Edit</a>
                                                        @endcan
                                                        @csrf
                                                        @method('DELETE')
                                                        @can('product-delete')
                                                        <a class="dropdown-item"><i class="icon-trash">Delete</a>
                                                        @endcan
                                                    </form>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                {{--  @foreach($productections as $producte)
                    <div class="tab-pane fade" id="s{{$producte->id}}">                         <table class="table datatable-button-html5-columns">
                            <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Photo</th>
                                <th>Name</th>
                                <th>ADM_No</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($producttudents->where('section_id', $producte->id) as $productr)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><img class="rounded-circle" style="height: 40px; width: 40px;" src="{{ $productr->user->photo }}" alt="photo"></td>
                                    <td>{{ $productr->user->name }}</td>
                                    <td>{{ $productr->adm_no }}</td>
                                    <td>{{ $productr->user->email }}</td>
                                    <td class="text-center">
                                        <div class="list-icons">
                                            <div class="dropdown">
                                                <a href="#" class="list-icons-item" data-toggle="dropdown">
                                                    <i class="icon-menu9"></i>
                                                </a>

                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a href="{{ route('students.show', Qs::hash($productr->id)) }}" class="dropdown-item"><i class="icon-eye"></i> View Info</a>
                                                    @if(Qs::userIsTeamSA())
                                                        <a href="{{ route('students.edit', Qs::hash($productr->id)) }}" class="dropdown-item"><i class="icon-pencil"></i> Edit</a>
                                                        <a href="{{ route('st.reset_pass', Qs::hash($productr->user->id)) }}" class="dropdown-item"><i class="icon-lock"></i> Reset password</a>
                                                    @endif
                                                    <a href="#" class="dropdown-item"><i class="icon-check"></i> Marksheet</a>

                                                    {{--Delete--}}
                                                    {{--  @if(Qs::userIsSuperAdmin())
                                                        <a id="{{ Qs::hash($productr->user->id) }}" onclick="confirmDelete(this.id)" href="#" class="dropdown-item"><i class="icon-trash"></i> Delete</a>
                                                        <form method="post" id="item-delete-{{ Qs::hash($productr->user->id) }}" action="{{ route('students.destroy', Qs::hash($productr->user->id)) }}" class="hidden">@csrf @method('delete')</form>
                                                    @endif

                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                @endforeach    --}}

            </div>
        </div>
    </div>

    {{--Student List Ends--}}

@endsection
