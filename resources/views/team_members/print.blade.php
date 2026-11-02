<!DOCTYPE html>
<html>
<head>
    <title>Print Team Member - {{ $teamMember->name }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { font-family: sans-serif; }
        @media print {
            .no-print { display: none; }
        }
        .id-card {
            border: 1px solid #000;
            padding: 20px;
            width: 400px;
            margin: 0 auto;
            text-align: center;
        }
    </style>
</head>
<body onload="window.print()">

<div class="container mt-4">
    <div class="d-flex justify-content-between no-print mb-4">
        <a href="{{ route('team_members.index') }}" class="btn btn-secondary">Back</a>
        <button onclick="window.print()" class="btn btn-primary">Print</button>
    </div>

    <div class="id-card">
        @if($teamMember->profile_pic)
            <img src="{{ asset('storage/'.$teamMember->profile_pic) }}" width="100" class="rounded-circle mb-3">
        @else
            <div style="width: 100px; height: 100px; background: #ccc; border-radius: 50%; margin: 0 auto 15px;"></div>
        @endif
        
        <h3>{{ $teamMember->name }}</h3>
        <p class="text-muted">{{ $teamMember->designation }}</p>
        
        <div class="text-start mt-4">
            <p><strong>Mobile:</strong> {{ $teamMember->mobile }}</p>
            <p><strong>Address:</strong> {{ $teamMember->address }}</p>
            <p><strong>ID:</strong> #{{ $teamMember->id }}</p>
        </div>
    </div>
    
    <div class="mt-5 text-center">
        <h4>ID Card Images</h4>
        <div class="row justify-content-center">
            <div class="col-6">
                @if($teamMember->id_card_front)
                    <p><strong>Front</strong></p>
                    <img src="{{ asset('storage/'.$teamMember->id_card_front) }}" class="img-fluid" style="max-height: 200px; border: 1px solid #ddd;">
                @endif
            </div>
            <div class="col-6">
                 @if($teamMember->id_card_back)
                    <p><strong>Back</strong></p>
                    <img src="{{ asset('storage/'.$teamMember->id_card_back) }}" class="img-fluid" style="max-height: 200px; border: 1px solid #ddd;">
                @endif
            </div>
        </div>
    </div>
</div>

</body>
</html>
