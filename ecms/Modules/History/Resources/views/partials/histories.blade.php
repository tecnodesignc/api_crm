<li class="dropdown messages-menu">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
        <i class="fa fa-bell-o"></i>
        <span class="label label-success historiesCounter animated">{{ $histories->count() }}</span>
    </a>
    <ul class="dropdown-menu">
        <li>
            <div class="slimScrollDiv">
                <ul class="menu histories-list">
                    <?php if ($histories->count() === 0): ?>
                    <li class="noHistories">
                        <a href="#">
                            {{ trans('history::messages.no histories') }}
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php foreach ($histories as $history): ?>
                    <li>
                        <a href="{{ $history->link }}">
                            <div class="pull-left historyIcon">
                                <i class="{{ $history->icon_class }}"></i>
                            </div>
                            <h4>
                                {{ $history->title }}
                                <small>
                                    <i class="fa fa-clock-o"></i> {{ $history->time_ago }}
                                    <i class="fa fa-close removeHistory" data-id="{{ $history->id }}"></i>
                                </small>
                            </h4>
                            <p>{{ $history->message }}</p>
                        </a>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <li class="footer"><a href="{{ route('admin.history.history.index') }}">{!! trans('history::messages.view all') !!}</a></li>
        </li>
    </ul>
</li>

@push('js-stack')
<script>
    $( document ).ready(function() {
        $('.removeHistory').on('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            var self = this;
            $.ajax({
                type: 'POST',
                url: '{{ route('api.history.read') }}',
                data: {
                    'id': $(this).data('id'),
                    '_token': '{{ csrf_token() }}'
                },
                success: function(data) {
                    if (data.updated) {
                        var history = $(self).closest('li');
                        history.addClass('animated fadeOut');
                        setTimeout(function() {
                            history.remove();
                        }, 510)
                        var count = parseInt($('.historiesCounter').text());
                        $('.historiesCounter').text(count - 1);
                    }
                }
            });
        });
    });
</script>
@endpush
