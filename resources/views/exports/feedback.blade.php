<table>
    <thead>
        <tr>
            <th>Sr.No</th>
            <th>Email</th>
            <th style="text-align:right;">Created At</th>
            @foreach($feedBackQuestions as $question)
            <th>{{$question}}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @if(count($feedbacks)>0)
            @php
                $i = 1;
            @endphp
            @foreach($feedbacks as $feedback)
                <tr> 
                    <td>{{$i++}}</td>
                    <td>{{$feedback['email']}}</td>
                    <td style="text-align:right;">{{ date("m/d/Y", strtotime($feedback['created_at'])) }}</td>
                    @foreach($feedBackQuestions as $question)
                    <td>
                    @if(isset($feedback[$question]))
                        {{$feedback[$question]}}
                    @else
                    N/A
                    @endif
                    </td>
                    @endforeach
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