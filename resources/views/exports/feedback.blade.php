<table>
    <thead>
        <tr>
        <th></th>
        <th>Sr.No</th>
        <th>Email</th>
        <th >Created At</th>
        </tr>
    </thead>
    <tbody>
        @if(count($feedbacks)>0)
            @php
                $i = 1;
            @endphp
            @foreach($feedbacks as $feedback)
                <tr> 
                    <td>
                        {{$i++}}
                    </td>
                    <td>{{$feedback->user ? $feedback->user->email  : '-'}}</td>
                    <td>
                    {{ date("m/d/Y", strtotime($feedback->created_at)) }} 
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="3">
                        <div>
                        @foreach(json_decode($feedback->feedback_rating) as $ratting)  
                        <div class="row mb-2">
                            <div class="col-6">{{$ratting->question_name}}</div>
                            <div class="col-6 text-right">
                            {{$ratting->value}}
                            </div>
                        </div>
                        @endforeach
                        </div>
                    </td>
                </tr>
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