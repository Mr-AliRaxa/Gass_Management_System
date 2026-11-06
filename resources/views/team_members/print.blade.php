<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Print Team Member - {{ $teamMember->name }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --primary: #1e3a8a;
            --accent: #3b82f6;
            --light: #f8fafc;
            --border: #e2e8f0;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #eef2f7;
            color: #1e293b;
        }

        /* ---------- Screen Layout ---------- */
        .page-wrapper {
            max-width: 900px;
            margin: 30px auto;
            padding: 0 15px;
        }

        .action-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .action-bar .btn {
            border-radius: 10px;
            padding: 10px 22px;
            font-weight: 600;
        }

        /* ---------- ID Card ---------- */
        .id-card {
            background: #fff;
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 12px 35px rgba(30, 58, 138, 0.15);
            border: 1px solid var(--border);
            max-width: 460px;
            margin: 0 auto 40px;
            position: relative;
        }

        .id-card-header {
            background: linear-gradient(135deg, var(--primary) 0%, var(--accent) 100%);
            padding: 22px 25px;
            color: #fff;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .id-card-header .company {
            font-size: 1.1rem;
            font-weight: 700;
            letter-spacing: 0.5px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .id-card-header .badge-id {
            background: rgba(255, 255, 255, 0.2);
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .id-card-body {
            padding: 30px 25px 20px;
            text-align: center;
        }

        .avatar-wrap {
            width: 130px;
            height: 130px;
            margin: -85px auto 15px;
            border-radius: 50%;
            border: 5px solid #fff;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            background: #cbd5e1;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .avatar-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .avatar-wrap .placeholder-icon {
            font-size: 55px;
            color: #fff;
        }

        .member-name {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 4px;
        }

        .member-designation {
            font-size: 0.95rem;
            color: #64748b;
            font-weight: 500;
            letter-spacing: 0.3px;
            margin-bottom: 22px;
        }

        .info-list {
            text-align: left;
            border-top: 1px dashed var(--border);
            padding-top: 20px;
        }

        .info-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 10px 0;
            border-bottom: 1px solid #f1f5f9;
        }

        .info-item:last-child {
            border-bottom: none;
        }

        .info-icon {
            width: 34px;
            height: 34px;
            flex-shrink: 0;
            background: #eff6ff;
            color: var(--accent);
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.95rem;
        }

        .info-content {
            flex: 1;
        }

        .info-label {
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 0.6px;
            color: #94a3b8;
            font-weight: 600;
            margin-bottom: 2px;
        }

        .info-value {
            font-size: 0.92rem;
            color: #1e293b;
            font-weight: 500;
            word-break: break-word;
        }

        .id-card-footer {
            background: var(--light);
            padding: 12px 25px;
            text-align: center;
            font-size: 0.72rem;
            color: #94a3b8;
            letter-spacing: 0.4px;
            border-top: 1px solid var(--border);
        }

        /* ---------- ID Card Images Section ---------- */
        .images-section {
            background: #fff;
            border-radius: 18px;
            padding: 28px;
            border: 1px solid var(--border);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.04);
        }

        .section-title {
            font-size: 1.15rem;
            font-weight: 700;
            color: var(--primary);
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 22px;
            padding-bottom: 12px;
            border-bottom: 2px solid var(--border);
        }

        .section-title i {
            color: var(--accent);
        }

        .card-image-block {
            background: var(--light);
            border: 1px dashed #cbd5e1;
            border-radius: 12px;
            padding: 14px;
            text-align: center;
            height: 100%;
        }

        .card-image-block .label {
            font-size: 0.72rem;
            text-transform: uppercase;
            letter-spacing: 0.6px;
            font-weight: 700;
            color: #64748b;
            margin-bottom: 10px;
        }

        .card-image-block img {
            max-width: 100%;
            max-height: 190px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .no-image-text {
            color: #94a3b8;
            font-size: 0.85rem;
            padding: 40px 0;
        }

        /* ---------- Print Styles ---------- */
        @media print {
            @page {
                size: A4;
                margin: 12mm;
            }

            body {
                background: #fff !important;
            }

            .no-print {
                display: none !important;
            }

            .page-wrapper {
                max-width: 100%;
                margin: 0;
                padding: 0;
            }

            .id-card {
                box-shadow: none;
                border: 2px solid var(--primary);
                page-break-inside: avoid;
            }

            .id-card-header {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .images-section {
                box-shadow: none;
                page-break-inside: avoid;
            }

            .section-title {
                page-break-after: avoid;
            }
        }
    </style>
</head>

<body onload="window.print()">

    <div class="page-wrapper">

        <!-- Action Buttons -->
        <div class="action-bar no-print">
            <a href="{{ route('team_members.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Back
            </a>
            <button onclick="window.print()" class="btn btn-primary">
                <i class="bi bi-printer"></i> Print ID Card
            </button>
        </div>

        <!-- ID Card -->
        <div class="id-card">
            <div class="id-card-header">
                <div class="company">
                    <i class="bi bi-shield-check"></i> TEAM MEMBER
                </div>
                <div class="badge-id">ID #{{ str_pad($teamMember->id, 4, '0', STR_PAD_LEFT) }}</div>
            </div>

            <div class="id-card-body">
                <div class="avatar-wrap">
                    @if($teamMember->profile_pic)
                        <img src="{{ asset('storage/' . $teamMember->profile_pic) }}" alt="{{ $teamMember->name }}">
                    @else
                        <i class="bi bi-person-fill placeholder-icon"></i>
                    @endif
                </div>

                <div class="member-name">{{ $teamMember->name }}</div>
                <div class="member-designation">{{ $teamMember->designation }}</div>

                <div class="info-list">
                    <div class="info-item">
                        <div class="info-icon"><i class="bi bi-telephone-fill"></i></div>
                        <div class="info-content">
                            <div class="info-label">Mobile Number</div>
                            <div class="info-value">{{ $teamMember->mobile ?? 'N/A' }}</div>
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="info-icon"><i class="bi bi-geo-alt-fill"></i></div>
                        <div class="info-content">
                            <div class="info-label">Address</div>
                            <div class="info-value">{{ $teamMember->address ?? 'N/A' }}</div>
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="info-icon"><i class="bi bi-person-badge-fill"></i></div>
                        <div class="info-content">
                            <div class="info-label">Member ID</div>
                            <div class="info-value">#{{ $teamMember->id }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="id-card-footer">
                <i class="bi bi-check-circle-fill text-success"></i>
                This card is the property of the organization
            </div>
        </div>

        <!-- ID Card Images -->
        <div class="images-section">
            <h5 class="section-title">
                <i class="bi bi-images"></i> ID Card Documents
            </h5>

            <div class="row g-3 justify-content-center">
                <div class="col-md-6">
                    <div class="card-image-block">
                        <div class="label"><i class="bi bi-file-earmark-image"></i> Front Side</div>
                        @if($teamMember->id_card_front)
                            <img src="{{ asset('storage/' . $teamMember->id_card_front) }}" alt="ID Card Front">
                        @else
                            <div class="no-image-text">
                                <i class="bi bi-image" style="font-size: 2rem; display: block; margin-bottom: 6px;"></i>
                                No front image uploaded
                            </div>
                        @endif
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card-image-block">
                        <div class="label"><i class="bi bi-file-earmark-image"></i> Back Side</div>
                        @if($teamMember->id_card_back)
                            <img src="{{ asset('storage/' . $teamMember->id_card_back) }}" alt="ID Card Back">
                        @else
                            <div class="no-image-text">
                                <i class="bi bi-image" style="font-size: 2rem; display: block; margin-bottom: 6px;"></i>
                                No back image uploaded
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>

</body>

</html>