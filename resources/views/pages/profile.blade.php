@extends('layouts.dashboard')
@section('title', 'My Profile')

@section('dashboard-content')

<h1 class="admin-title">My Profile</h1>

<div class="row">
    <div class="col-lg-12">

        {{-- ── Personal Information ── --}}
        <div class="profile-card">
            <h5 class="fw-7 mb-24" style="font-size:17px;">Personal Information</h5>
            <form method="POST" action="{{ route('profile.update') }}">
                @csrf @method('PATCH')
                <div class="row g-20">
                    <div class="col-md-6">
                        <label style="font-size:12px;font-weight:600;color:#64748b;display:block;margin-bottom:6px;text-transform:uppercase;letter-spacing:0.4px;">Full Name</label>
                        <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" class="tb-my-input" style="width:100%;" placeholder="Your full name" required>
                        @error('name')<p style="color:#dc2626;font-size:12px;margin-top:4px;">{{ $message }}</p>@enderror
                    </div>
                    <div class="col-md-6">
                        <label style="font-size:12px;font-weight:600;color:#64748b;display:block;margin-bottom:6px;text-transform:uppercase;letter-spacing:0.4px;">Email Address</label>
                        <input type="email" value="{{ auth()->user()->email }}" class="tb-my-input" style="width:100%;background:#f8fafc;" readonly>
                        <p style="font-size:11px;color:#94a3b8;margin-top:4px;">Email cannot be changed. Contact support if needed.</p>
                    </div>
                    <div class="col-md-6">
                        <label style="font-size:12px;font-weight:600;color:#64748b;display:block;margin-bottom:6px;text-transform:uppercase;letter-spacing:0.4px;">Phone Number</label>
                        <input type="tel" name="phone" value="{{ old('phone', auth()->user()->phone) }}" class="tb-my-input" style="width:100%;" placeholder="+254 700 000 000">
                        @error('phone')<p style="color:#dc2626;font-size:12px;margin-top:4px;">{{ $message }}</p>@enderror
                    </div>
                    <div class="col-md-6">
                        <label style="font-size:12px;font-weight:600;color:#64748b;display:block;margin-bottom:6px;text-transform:uppercase;letter-spacing:0.4px;">WhatsApp Number</label>
                        <input type="tel" name="whatsapp_number" value="{{ old('whatsapp_number', auth()->user()->whatsapp_number ?? auth()->user()->phone) }}" class="tb-my-input" style="width:100%;" placeholder="+254 700 000 000">
                        <p style="font-size:11px;color:#94a3b8;margin-top:4px;">Used for buyer contact on your listings.</p>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="sc-button"><span>Save Changes</span></button>
                    </div>
                </div>
            </form>
        </div>

        {{-- ── Change Password ── --}}
        <div class="profile-card">
            <h5 class="fw-7 mb-24" style="font-size:17px;">Change Password</h5>
            <form method="POST" action="{{ route('profile.password') }}">
                @csrf @method('PATCH')
                <div class="row g-20">
                    <div class="col-md-6">
                        <label style="font-size:12px;font-weight:600;color:#64748b;display:block;margin-bottom:6px;text-transform:uppercase;letter-spacing:0.4px;">Current Password</label>
                        <input type="password" name="current_password" class="tb-my-input" style="width:100%;" placeholder="Enter current password">
                        @error('current_password')<p style="color:#dc2626;font-size:12px;margin-top:4px;">{{ $message }}</p>@enderror
                    </div>
                    <div class="col-md-6">
                        <label style="font-size:12px;font-weight:600;color:#64748b;display:block;margin-bottom:6px;text-transform:uppercase;letter-spacing:0.4px;">New Password</label>
                        <input type="password" name="password" class="tb-my-input" style="width:100%;" placeholder="Min. 8 characters">
                        @error('password')<p style="color:#dc2626;font-size:12px;margin-top:4px;">{{ $message }}</p>@enderror
                    </div>
                    <div class="col-md-6">
                        <label style="font-size:12px;font-weight:600;color:#64748b;display:block;margin-bottom:6px;text-transform:uppercase;letter-spacing:0.4px;">Confirm New Password</label>
                        <input type="password" name="password_confirmation" class="tb-my-input" style="width:100%;" placeholder="Repeat new password">
                    </div>
                    <div class="col-12">
                        <button type="submit" class="sc-button style-1"><span>Update Password</span></button>
                    </div>
                </div>
            </form>
        </div>

        {{-- ── Account Overview ── --}}
        <div class="profile-card">
            <h5 class="fw-7 mb-20" style="font-size:17px;">Account Overview</h5>
            <div class="row g-16">
                <div class="col-6 col-md-3">
                    <div style="text-align:center;padding:16px;background:#f8fafc;border-radius:10px;">
                        <div style="font-size:28px;font-weight:800;color:var(--color-main);">{{ auth()->user()->vehicles()->count() }}</div>
                        <div style="font-size:12px;color:#64748b;margin-top:4px;">Total Listings</div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div style="text-align:center;padding:16px;background:#f8fafc;border-radius:10px;">
                        <div style="font-size:28px;font-weight:800;color:#15803d;">{{ auth()->user()->vehicles()->where('status','active')->count() }}</div>
                        <div style="font-size:12px;color:#64748b;margin-top:4px;">Active</div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div style="text-align:center;padding:16px;background:#f8fafc;border-radius:10px;">
                        <div style="font-size:28px;font-weight:800;color:#1d4ed8;">{{ number_format(auth()->user()->vehicles()->sum('views_count')) }}</div>
                        <div style="font-size:12px;color:#64748b;margin-top:4px;">Total Views</div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div style="text-align:center;padding:16px;background:#f8fafc;border-radius:10px;">
                        <div style="font-size:28px;font-weight:800;color:#7c3aed;">{{ auth()->user()->savedVehicles()->count() }}</div>
                        <div style="font-size:12px;color:#64748b;margin-top:4px;">Saved Cars</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ── Danger Zone ── --}}
        <div class="profile-card" style="border-color:#fee2e2;">
            <h5 class="fw-7 mb-8" style="font-size:17px;color:#dc2626;">Danger Zone</h5>
            <p style="font-size:14px;color:#64748b;margin-bottom:16px;">Once you delete your account, all your listings and data will be permanently removed. This action cannot be undone.</p>
            <a href="mailto:hello@autovault.co.ke?subject=Account+Deletion+Request&body=Please+delete+my+account+for+{{ urlencode(auth()->user()->email) }}"
               style="display:inline-flex;align-items:center;gap:8px;padding:10px 20px;background:#fee2e2;color:#dc2626;border-radius:6px;font-size:14px;font-weight:600;text-decoration:none;border:1.5px solid #fca5a5;">
                Request Account Deletion
            </a>
        </div>

    </div>
</div>

@endsection
