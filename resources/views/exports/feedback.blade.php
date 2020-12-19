<table>
    <thead>
        <tr>
            <th>Sr.No</th>
            <th>Email</th>
            <th style="text-align:right;">Created At</th>
        </tr>
    </thead>
    <tbody>
        @if(count($feedbacks)>0)
            @php
                $i = 1;
            @endphp
            @foreach($feedbacks as $feedback)
                <tr> 
                    <th>{{$i++}}</th>
                    <th>{{$feedback->user ? $feedback->user->email  : '-'}}</th>
                    <th style="text-align:right;">{{ date("m/d/Y", strtotime($feedback->created_at)) }}</th>
                </tr>
                @foreach(json_decode($feedback->feedback_rating) as $ratting) 
                <tr> 
                    <td></td>
                    <td>{{$ratting->question_name}}</td>
                    <td style="text-align:right;">{{$ratting->value}}</td>
                </tr>
                @endforeach
            @endforeach
        @else
        <tr>
            <th colspan="6">
                No data found.
            </th>
        </tr>
        @endif
    </tbody>
</table>