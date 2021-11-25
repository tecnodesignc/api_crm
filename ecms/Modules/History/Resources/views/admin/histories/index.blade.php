@extends('layouts.master')

@section('content-header')
<h1>
    {{ trans('history::messages.histories') }}
    <small><span class="badge">{{ $histories->count() }}</span></small>
</h1>
<ol class="breadcrumb">
    <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
    <li class="active">{{ trans('history::messages.histories') }}</li>
</ol>
@stop

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="row">
            <div class="btn-group pull-right" style="margin: 0 15px 15px 0;">
                <a href="{{ route('admin.history.history.markAllAsRead') }}" class="btn btn-primary">{{ trans('history::messages.mark all as read') }}</a>
                <a href="#" class="btn btn-danger"  data-toggle="modal" data-target="#confirmation-delete-all">{{ trans('history::messages.delete all') }}</a>
            </div>
        </div>
        <div class="box box-primary">
            <div class="box-header">
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table class="data-table table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>{{ trans('history::messages.time') }}</th>
                            <th>{{ trans('history::messages.title') }}</th>
                            <th>{{ trans('history::messages.message') }}</th>
                            <th>{{ trans('history::messages.is read') }}</th>
                            <th width="10%" data-sortable="false">{{ trans('core::core.table.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if (isset($histories)): ?>
                        <?php foreach ($histories as $history): ?>
                            <tr>
                                <td>
                                    <a href="{{ $history->link }}">
                                        {{ $history->time_ago }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ $history->link }}">
                                        {{ $history->title }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ $history->link }}">
                                        {{ $history->message }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ $history->link }}">
                                        {{ $history->is_read ? 'Read' : 'Unread' }}
                                    </a>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-danger btn-flat" data-toggle="modal" data-target="#modal-delete-confirmation" data-action-target="{{ route('admin.history.history.destroy', [$history->id]) }}"><i class="fa fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>{{ trans('history::messages.time') }}</th>
                            <th>{{ trans('history::messages.title') }}</th>
                            <th>{{ trans('history::messages.message') }}</th>
                            <th>{{ trans('history::messages.is read') }}</th>
                            <th>{{ trans('core::core.table.actions') }}</th>
                        </tr>
                    </tfoot>
                </table>
            <!-- /.box-body -->
            </div>
        <!-- /.box -->
    </div>
    </div>
</div>
@include('core::partials.delete-modal')
<div class="modal fade modal-danger" id="confirmation-delete-all" tabindex="-1" role="dialog" aria-labelledby="deleteAll" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">{{ trans('core::core.modal.title') }}</h4>
            </div>
            <div class="modal-body">
                {{ trans('history::messages.delete all confirmation') }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline btn-flat" data-dismiss="modal">{{ trans('core::core.button.cancel') }}</button>
                {!! Form::open(['route' => ['admin.history.history.destroyAll'], 'method' => 'delete', 'class' => 'pull-left']) !!}
                <button type="submit" class="btn btn-outline btn-flat"><i class="glyphicon glyphicon-trash"></i> {{ trans('core::core.button.delete') }}</button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@stop

@section('footer')
    <a data-toggle="modal" data-target="#keyboardShortcutsModal"><i class="fa fa-keyboard-o"></i></a> &nbsp;
@stop
@section('shortcuts')
    <dl class="dl-horizontal">
        <dt><code>r</code></dt>
        <dd>{{ trans('history::messages.mark all as read') }}</dd>
        <dt><code>d + a</code></dt>
        <dd>{{ trans('history::messages.delete all') }}</dd>
    </dl>
@stop

@section('scripts')
<?php $locale = App::getLocale(); ?>
<script type="text/javascript">
    $( document ).ready(function() {
        $(document).keypressAction({
            actions: [
                { key: 'r', route: "<?= route('admin.history.history.markAllAsRead') ?>" },
                { key: 'd a', route: "<?= route('admin.history.history.destroyAll') ?>" }
            ]
        });
    });
    $(function () {
        $('.data-table').dataTable({
            "paginate": true,
            "lengthChange": true,
            "filter": true,
            "sort": true,
            "info": true,
            "autoWidth": true,
            "ordering": true,
            "language": {
                "url": '<?php echo Module::asset("core:js/vendor/datatables/{$locale}.json") ?>'
            }
        });
    });
</script>
@stop
