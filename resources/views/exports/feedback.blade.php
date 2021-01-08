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
                    <th>{{$i++}}</th>
                    <th>{{$feedback['email']}}</th>
                    <th style="text-align:right;">{{ date("m/d/Y", strtotime($feedback['created_at'])) }}</th>
                    @foreach($feedBackQuestions as $question)
                    <th>{{$feedback[$question]}}</th>
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