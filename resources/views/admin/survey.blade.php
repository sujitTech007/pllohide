@include('admin.include.header')

<style>
    .main-panel {
        min-width:1200px
    }
    .main-panel .form_table .table tr th:last-child {
    min-width: 150px;
}
</style>

<div class="row">
<div class="content-wrapper">
    <div class="dashboard_inner">
        <div class="heading_admin">
            <h3>All Posts</h3>
        </div>

        <div class="task_frm form_table">
            <div class="tabel_scoller table-responsive">
                <table class="table">
                    <thead>

                        <tr>
                            <th>#</th>
                            <th>Role</th>
                            <th>Frequency</th>
                            <th>Challenges</th>
                            <th>Offerings</th>
                            <th>Sustainability</th>
                            <th>Platform Interest</th>
                            <th>Preferences</th>
                            <th>Feedback</th>
                            <th>Other Notes</th>
                            <th>Improvements</th>
                            <th>Submitted At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($surveys as $index => $survey)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $survey->role }}</td>
                            <td>{{ $survey->frequency }}</td>
                            <td>
                                @php
                                    $challenges = json_decode($survey->challenges, true);
                                @endphp
                                @if($challenges && is_array($challenges))
                                    <ul style="padding-left: 16px;">
                                        @foreach($challenges as $challenge)
                                            <li>{{ ucfirst(str_replace('_', ' ', $challenge)) }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    <em>No challenges</em>
                                @endif
                            </td>
                            <td>{{ $survey->pllohide_offerings }}</td>
                            <td>{{ ucfirst(str_replace('_', ' ', $survey->sustainability_importance)) }}</td>
                            <td>{{ ucfirst($survey->platform_interest) }}</td>
                            <td>
                                {{ $survey->preference1 }}
                                @if($survey->preference2)
                                    , {{ $survey->preference2 }}
                                @endif
                            </td>
                            <td>{{ ucfirst($survey->feedback) }}</td>
                            <td>{{ $survey->other }}</td>
                            <td>{{ $survey->improvements }}</td>
                            <td>{{ $survey->created_at->format('d M Y, H:i') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                @if($surveys->isEmpty())
                    <div class="text-center py-4">
                        <em>No survey entries found.</em>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
</div>

@include('admin.include.footer')
