@extends('layouts.app')

@section('content')
<div class="container">
    @if(Session::has('message'))
        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Import Users From Google Sheets') }}</div>

                <div class="card-body">
                    <div>
                        <p><span class="text-danger">Note</span>: Spreadsheet Id and sheet name can be given in .env file if not given please enter the details to import the users.</p>
                    </div>
                    <div class="mt-1">
                        <form action="{{ route('users.store') }}" method="POST">
                            {{csrf_field()}}
                            <div class="input-group">
                                <input type="text" class="form-control" name="spreadsheet_id" placeholder="SpreadSheet ID"/>
                                <span class="input-group-addon">-</span>
                                <input type="text" class="form-control" name="sheet_name" placeholder="Sheet Name"/>
                            </div>
                            <div class="text-center">
                                <button class="btn btn-primary mt-1 float-right" type="submit">Import</button>
                            </div>
                        </form>
                    </div>
                    
                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
