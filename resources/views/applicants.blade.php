<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Applicant Details</title>
</head>
<body>

    <h1>Applicant Details</h1>

    <h2>Name: {{ $applicant->name }}</h2>
    <p>Age: {{ $applicant->age }} years</p>
    <p>City: {{ $applicant->city }}</p>
    <p>Email: {{ $applicant->email }}</p>
    <p>Phone Number: {{ $applicant->phone_number }}</p>

    <h3>Curriculum:</h3>
    <p>Experience: {{ $applicant->curriculum->experience }}</p>
    <p>Projects: {{ $applicant->curriculum->projects }}</p>

    <h3>Skills:</h3>
    <ul>
        @foreach ($applicant->curriculum->skills as $skill)
            <li>{{ $skill->skill_name }} (Level: {{ $skill->level }})</li>
        @endforeach
    </ul>

    <h3>Predictions:</h3>
    <ul>
        @foreach ($applicant->curriculum->predictions as $prediction)
            <li>{{ $prediction->predictions }}</li>
        @endforeach
    </ul>

    <h3>Job Matches:</h3>
    <ul>
        @foreach ($applicant->curriculum->jobMatches as $jobMatch)
            <li>Percentaje: {{ $jobMatch->percentaje }}%</li>
        @endforeach
    </ul>

</body>
</html>