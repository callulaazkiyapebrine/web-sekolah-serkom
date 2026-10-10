@extends('admin')

@section('title', 'Detail User - MAN 2 Tasikmalaya')

@section('content')

<style>
    .detail-user {
        max-width: 1100px;
        margin: 0 auto;
        padding-top: 4px;
        color: #26352c;
    }

    .user-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 16px;
        margin-bottom: 28px;
    }

    .user-header h2 {
        color: #0b5d3b;
        font-size: 1.8rem;
        font-weight: 700;
        margin-bottom: 6px;
    }

    .user-header p {
        color: #78847c;
        margin: 0;
        font-size: .95rem;
    }

    .btn-kembali-user {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 10px 18px;
        border: 1px solid #0b5d3b;
        border-radius: 9px;
        color: #0b5d3b;
        background: white;
        text-decoration: none;
        font-size: .9rem;
        font-weight: 600;
        white-space: nowrap;
        transition: .2s;
    }

    .btn-kembali-user:hover {
        background: #0b5d3b;
        color: white;
    }

    .user-card {
        background: white;
        border: 1px solid #e5ebe6;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(20, 60, 35, .05);
    }

    .user-card-header {
        display: flex;
        align-items: center;
        gap: 18px;
        padding: 28px 32px;
        background: #f1f7f2;
        border-bottom: 1px solid #e2ebe4;
    }

    .user-avatar {
        width: 64px;
        height: 64px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #dceee1;
        color: #0b5d3b;
        border-radius: 14px;
    }

    .user-avatar i {
        width: 30px;
        height: 30px;
    }

    .user-label {
        display: inline-block;
        color: #0b5d3b;
        font-size: .78rem;
        font-weight: 700;
        letter-spacing: .4px;
        text-transform: uppercase;
        margin-bottom: 7px;
    }

    .user-username {
        color: #173d29;
        font-size: 1.7rem;
        line-height: 1.4;
        font-weight: 700;
        margin: 0;
        overflow-wrap: anywhere;
    }

    .user-card-body {
        padding: 30px 32px;
    }

    .user-section-title {
        color: #0b5d3b;
        font-size: 1.05rem;
        font-weight: 700;
        margin-bottom: 20px;
    }

    .user-info-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 16px;
    }

    .user-info-item {
        display: flex;
        align-items: flex-start;
        gap: 14px;
        padding: 20px;
        background: #f8faf8;
        border: 1px solid #e8eee9;
        border-radius: 11px;
        min-width: 0;
    }

    .user-info-icon {
        width: 42px;
        height: 42px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #dceee1;
        color: #0b5d3b;
        border-radius: 10px;
    }

    .user-info-icon i {
        width: 19px;
        height: 19px;
    }

    .user-info-label {
        color: #78847c;
        font-size: .84rem;
        margin-bottom: 6px;
    }

    .user-info-value {
        color: #26352c;
        font-size: .98rem;
        font-weight: 600;
        overflow-wrap: anywhere;
    }

    .user-role {
        display: inline-block;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: .82rem;
        font-weight: 700;
    }

    .user-role.admin {
        background: #dceee1;
        color: #0b5d3b;
    }

    .user-role.operator {
        background: #eceff1;
        color: #58636b;
    }

    .user-password {
        letter-spacing: 2px;
        color: #526157;
    }

    .user-card-footer {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
        padding: 18px 32px;
        background: #fbfcfb;
        border-top: 1px solid #e8eee9;
    }

    .btn-edit-user {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 10px 18px;
        background: #0b5d3b;
        color: white;
        border: 1px solid #0b5d3b;
        border-radius: 9px;
        text-decoration: none;
        font-size: .9rem;
        font-weight: 600;
        transition: .2s;
    }

    .btn-edit-user:hover {
        background: #08482d;
        border-color: #08482d;
        color: white;
    }

    .btn-edit-user i {
        width: 16px;
        height: 16px;
    }

    @media (max-width: 576px) {
        .detail-user {
            padding: 10px 0;
        }

        .user-header {
            align-items: flex-start;
            flex-direction: column;
        }

        .user-header h2 {
            font-size: 1.5rem;
        }

        .user-card-header {
            align-items: flex-start;
            gap: 14px;
            padding: 22px 18px;
        }

        .user-avatar {
            width: 50px;
            height: 50px;
        }

        .user-avatar i {
            width: 24px;
            height: 24px;
        }

        .user-username {
            font-size: 1.35rem;
        }

        .user-card-body {
            padding: 22px 18px;
        }

        .user-info-grid {
            grid-template-columns: 1fr;
            gap: 12px;
        }

        .user-info-item {
            padding: 16px;
        }

        .user-card-footer {
            padding: 16px 18px;
        }
    }
</style>

<div class="container-fluid pt-2 pb-4">
    <div class="detail-user">

        {{-- HEADER --}}
        <div class="user-header">
            <div>
                <h2>Detail User</h2>
                <p>Informasi akun dan hak akses pengguna.</p>
            </div>

            <a href="{{ route('admin.user.index') }}"
                class="btn-kembali-user">
                <i data-feather="arrow-left"></i>
                Kembali
            </a>
        </div>

        {{-- KARTU DETAIL --}}
        <div class="user-card">

            {{-- IDENTITAS USER --}}
            <div class="user-card-header">
                <div class="user-avatar">
                    <i data-feather="user"></i>
                </div>

                <div>
                    <span class="user-label">Informasi User</span>

                    <h1 class="user-username">
                        {{ $user->username }}
                    </h1>
                </div>
            </div>

            <div class="user-card-body">

                <h5 class="user-section-title">
                    <i data-feather="shield"
                        style="width:18px;height:18px;vertical-align:middle;margin-right:6px;">
                    </i>
                    Informasi Akun
                </h5>

                <div class="user-info-grid">

                    {{-- ID USER --}}
                    <div class="user-info-item">
                        <div class="user-info-icon">
                            <i data-feather="hash"></i>
                        </div>

                        <div>
                            <div class="user-info-label">ID User</div>
                            <div class="user-info-value">
                                {{ $user->id }}
                            </div>
                        </div>
                    </div>

                    {{-- USERNAME --}}
                    <div class="user-info-item">
                        <div class="user-info-icon">
                            <i data-feather="user"></i>
                        </div>

                        <div>
                            <div class="user-info-label">Username</div>
                            <div class="user-info-value">
                                {{ $user->username }}
                            </div>
                        </div>
                    </div>

                    {{-- ROLE --}}
                    <div class="user-info-item">
                        <div class="user-info-icon">
                            <i data-feather="shield"></i>
                        </div>

                        <div>
                            <div class="user-info-label">Role / Hak Akses</div>
                            <div class="user-info-value">
                                @if($user->role == 'admin')
                                <span class="user-role admin">Admin</span>
                                @else
                                <span class="user-role operator">Operator</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- PASSWORD --}}
                    <div class="user-info-item">
                        <div class="user-info-icon">
                            <i data-feather="lock"></i>
                        </div>

                        <div>
                            <div class="user-info-label">Password</div>
                            <div class="user-info-value user-password">
                                ********
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            {{-- TOMBOL --}}
            <div class="user-card-footer">

                @if(Auth::user()->role == 'admin')
                <a href="{{ route('admin.user.addEdit', Crypt::encrypt($user->id)) }}"
                    class="btn-edit-user">
                    <i data-feather="edit-3"></i>
                    Edit User
                </a>
                @endif

            </div>

        </div>
    </div>
</div>

@endsection