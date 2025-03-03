<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Curriculums</title>
</head>
<body>

    <h1>Curriculums</h1>

    @foreach ($curriculums as $curriculum)
        <div>
            <h2>Curriculum ID: {{ $curriculum->id }}</h2>
            <p>Experience: {{ $curriculum->experience }}</p>
            <p>Projects: {{ $curriculum->projects }}</p>

            <h3>Applicant:</h3>
            <p>Name: {{ $curriculum->applicant->name }}</p>
            <p>Age: {{ $curriculum->applicant->age }} years</p>
            <p>City: {{ $curriculum->applicant->city }}</p>
            <p>Email: {{ $curriculum->applicant->email }}</p>
            <p>Phone Number: {{ $curriculum->applicant->phone_number }}</p>

            <h3>Skills:</h3>
            <ul>
                @foreach ($curriculum->skills as $skill)
                    <li>{{ $skill->skill_name }} (Level: {{ $skill->level }})</li>
                @endforeach
            </ul>

            <h3>Predictions:</h3>
            <ul>
                @foreach ($curriculum->predictions as $prediction)
                    <li>{{ $prediction->predictions }}</li>
                @endforeach
            </ul>

            <h3>Job Matches:</h3>
            <ul>
                @foreach ($curriculum->jobMatches as $jobMatch)
                    <li>Percentaje: {{ $jobMatch->percentaje }}%</li>
                @endforeach
            </ul>

        </div>
    @endforeach

</body>
</html>