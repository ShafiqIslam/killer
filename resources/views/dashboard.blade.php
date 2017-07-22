@extends('layouts.app')

@section('content')
<div class="container" id="deathsController">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Deaths
                    <button type="button" class="btn btn-info pull-right" id="create_data_btn">
                        Add New Data
                    </button>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-body">
                    <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="deathList">
                        <thead>
                        <tr>
                            <th class="all">Date</th>
                            <th class="all">No. Of Deaths</th>
                            <th class="all">Source</th>
                            <th class="all">Created At</th>
                            <th class="all">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($deaths as $death)
                            <tr>
                                <td>{{ $death->date->toDateString() }}</td>
                                <td>{{ $death->deaths }}</td>
                                <td>{{ $death->news_src }}</td>
                                <td>{{ $death->created_at }}</td>
                                <td>
                                    <a class="btn green-meadow" onclick="editDeath({{$death}})">
                                        <i class="fa fa-pencil" aria-hidden="true"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('modals')
    <div id="deathCreate" class="modal bs-modal-lg fade" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{ URL::to('dashboard/death') }}" method="post" id="deathCreateForm" class="form-horizontal">
                    {{ csrf_field() }}
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title">Create Data</h4>
                    </div>
                    <div class="modal-body">
                        <div class="scroller" style="height:100%" data-always-visible="1" data-rail-visible1="1">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group @if($errors->has('date')) {{ 'has-error' }} @endif">
                                        <label for="createFieldDate" class='col-md-3 control-label'>Date</label>
                                        <div class="col-md-9">
                                            <input class="form-control" type="date" name="date" id="createFieldDate" required>
                                        </div>
                                    </div>

                                    <div class="form-group @if($errors->has('deaths')) {{ 'has-error' }} @endif">
                                        <label for="createFieldDeaths" class='col-md-3 control-label'>No of Deaths</label>
                                        <div class="col-md-9">
                                            <input class="form-control" type="number" min="0" name="deaths" id="createFieldDeaths" required>
                                        </div>
                                    </div>

                                    <div class="form-group @if($errors->has('news_title')) {{ 'has-error' }} @endif">
                                        <label for="createFieldTitle" class='col-md-3 control-label'>News Title</label>
                                        <div class="col-md-9">
                                            <input class="form-control" type="text" min="0" name="news_title" id="createFieldTitle">
                                        </div>
                                    </div>

                                    <div class="form-group @if($errors->has('news_source')) {{ 'has-error' }} @endif">
                                        <label for="createFieldSrc" class='col-md-3 control-label'>News Source</label>
                                        <div class="col-md-9">
                                            <input class="form-control" type="text" name="news_src" id="createFieldSrc" required>
                                        </div>
                                    </div>

                                    <div class="form-group @if($errors->has('news_detail')) {{ 'has-error' }} @endif">
                                        <label for="createFieldDetail" class='col-md-3 control-label'>News Details</label>
                                        <div class="col-md-9">
                                            <textarea class="form-control" name="news_detail" id="createFieldDetail"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-dismiss="modal" class="btn btn-default btn-outline">Close</button>
                        <input type="submit" class="btn btn-primary" value="Save">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="deathEdit" class="modal bs-modal-lg fade" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="" method="post" id="deathEditForm" class="form-horizontal">
                    {{ csrf_field() }}
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title">Edit Data</h4>
                    </div>
                    <div class="modal-body">
                        <div class="scroller" style="height:100%" data-always-visible="1" data-rail-visible1="1">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group @if($errors->has('date')) {{ 'has-error' }} @endif">
                                        <label for="editFieldDate" class='col-md-3 control-label'>Date</label>
                                        <div class="col-md-9">
                                            <input class="form-control" type="date" name="date" id="editFieldDate" required>
                                        </div>
                                    </div>

                                    <div class="form-group @if($errors->has('deaths')) {{ 'has-error' }} @endif">
                                        <label for="editFieldDeaths" class='col-md-3 control-label'>No of Deaths</label>
                                        <div class="col-md-9">
                                            <input class="form-control" type="number" min="0" name="deaths" id="editFieldDeaths" required>
                                        </div>
                                    </div>

                                    <div class="form-group @if($errors->has('news_title')) {{ 'has-error' }} @endif">
                                        <label for="editFieldTitle" class='col-md-3 control-label'>News Title</label>
                                        <div class="col-md-9">
                                            <input class="form-control" type="text" min="0" name="news_title" id="editFieldTitle">
                                        </div>
                                    </div>

                                    <div class="form-group @if($errors->has('news_source')) {{ 'has-error' }} @endif">
                                        <label for="editFieldSrc" class='col-md-3 control-label'>News Source</label>
                                        <div class="col-md-9">
                                            <input class="form-control" type="text" name="news_src" id="editFieldSrc" required>
                                        </div>
                                    </div>

                                    <div class="form-group @if($errors->has('news_detail')) {{ 'has-error' }} @endif">
                                        <label for="editFieldDetail" class='col-md-3 control-label'>News Details</label>
                                        <div class="col-md-9">
                                            <textarea class="form-control" name="news_detail" id="editFieldDetail"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-dismiss="modal" class="btn btn-default btn-outline">Close</button>
                        <input type="submit" class="btn btn-primary" value="Update">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    $('#deathList').DataTable({
        "order": [[0, "desc"]]
    });
    function editDeath(death) {
        $('#deathEditForm').attr('action', '{{ URL::to('dashboard/death') }}' + '/' + death.id);
        $('#editFieldDate').val(death.date.split(' ')[0]);
        $('#editFieldDeaths').val(death.deaths);
        $('#editFieldTitle').val(death.news_title);
        $('#editFieldDetail').val(death.news_detail);
        $('#editFieldSrc').val(death.news_src);
        $('#deathEdit').modal('show');
    }

    $('#create_data_btn').click(function() {
        $('#deathCreate').modal('show');
    });
</script>
@endsection
