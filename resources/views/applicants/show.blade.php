<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Applicant Details</title>
</head>
<body>

    <h1>Applicant Details</h1>

    {{-- Información del Applicant --}}
    <h2>Name: {{ $applicant->name }}</h2>
    <p><strong>Age:</strong> {{ $applicant->age }}</p>
    <p><strong>City:</strong> {{ $applicant->city }}</p>
    <p><strong>Email:</strong> {{ $applicant->email }}</p>
    <p><strong>Phone Number:</strong> {{ $applicant->phone_number }}</p>

    {{-- Información del Curriculum relacionado --}}
    <h3>Curriculum Information</h3>
    @if($applicant->curriculum)
        <p><strong>Curriculum ID:</strong> {{ $applicant->curriculum->id }}</p>
        <p><strong>Experience:</strong> {{ $applicant->curriculum->experience }}</p>
        <p><strong>Projects:</strong> {{ $applicant->curriculum->projects }}</p>
    @else
        <p>This applicant does not have a curriculum.</p>
    @endif

</body>
</html>