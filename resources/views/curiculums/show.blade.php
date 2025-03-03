<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Curriculum Details</title>
</head>
<body>

    <h1>Curriculum Details</h1>

    {{-- Información del Curriculum --}}
    <h2>Curriculum ID: {{ $curriculum->id }}</h2>
    <p><strong>Experience:</strong> {{ $curriculum->experience }}</p>
    <p><strong>Projects:</strong> {{ $curriculum->projects }}</p>

    {{-- Información del Applicant relacionado --}}
    <h3>Applicant Information</h3>
    <p><strong>Name:</strong> {{ $curriculum->applicant->name }}</p>
    <p><strong>Age:</strong> {{ $curriculum->applicant->age }} years</p>
    <p><strong>City:</strong> {{ $curriculum->applicant->city }}</p>
    <p><strong>Email:</strong> {{ $curriculum->applicant->email }}</p>
    <p><strong>Phone Number:</strong> {{ $curriculum->applicant->phone_number }}</p>

    {{-- Información de Skills --}}
    <h3>Skills</h3>
    @if($curriculum->skills->count() > 0)
        <ul>
            @foreach ($curriculum->skills as $skill)
                <li>{{ $skill->skill_name }} (Level: {{ $skill->level }})</li>
            @endforeach
        </ul>
    @else
        <p>No skills listed for this curriculum.</p>
    @endif

    {{-- Información de Predictions --}}
    <h3>Predictions</h3>
    @if($curriculum->predictions->count() > 0)
        <ul>
            @foreach ($curriculum->predictions as $prediction)
                <li>{{ $prediction->predictions }}</li>
            @endforeach
        </ul>
    @else
        <p>No predictions available for this curriculum.</p>
    @endif

    {{-- Información de Job Matches --}}
    <h3>Job Matches</h3>
    @if($curriculum->jobMatches->count() > 0)
        <ul>
            @foreach ($curriculum->jobMatches as $jobMatch)
                <li><strong>Percentage:</strong> {{ $jobMatch->percentaje }}%</li>
            @endforeach
        </ul>
    @else
        <p>No job matches available for this curriculum.</p>
    @endif

    {{-- Enlace para volver al listado de curriculums --}}
    <a href="{{ url('/curriculums') }}">Back to all curriculums</a>

</body>
</html>