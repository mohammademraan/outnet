@extends('users.layouts.master')

@section('content')

@php
  $rules = [
    ['1. Account Eligibility',
     'You must be at least 18 years old to create an account. Registration is free. A valid email, phone number, and referral code from an existing member are required to complete sign-up.'],
    ['2. Opening Balance',
     'New accounts receive a $5 welcome credit applied automatically. This credit is non-withdrawable and is intended to let you explore the platform.'],
    ['3. One Account Per Person',
     'Each phone number and email address may only be used to register one account. If duplicate accounts are detected, THE OUTNET reserves the right to freeze every related account and permanently prohibit the holder from using the platform.'],
    ['4. Account Security',
     'You are responsible for keeping your account password and wallet password confidential. THE OUTNET will never ask for your password. We cannot compensate for losses caused by your failure to safeguard your credentials.'],
    ['5. Daily Evaluations',
     'Your membership tier determines how many evaluations you can complete each day. Evaluations reset every day at 00:00 (server time). Unfinished evaluations from the previous day will not be carried over.'],
    ['6. Commission Structure',
     'Commission rates are set by your membership level and are credited to your wallet once an evaluation is submitted and confirmed. Standard items follow your tier\'s percentage; selected items carry a fixed higher rate as displayed on the evaluation screen.'],
    ['7. Minimum Balance',
     'A minimum balance of $50 is required in your wallet before you can start a new evaluation. If your balance is below this threshold, please recharge your account first.'],
    ['8. Deposit Verification',
     'Each deposit must be confirmed with Customer Support using the reference shown on your dashboard. THE OUTNET is not responsible for funds sent to an unverified address. All deposits remain pending until approved by our team.'],
    ['9. Account Suspension',
     'If an account is suspended, our compliance team will review the case and decide whether to reinstate the account. Repeated violations will result in permanent removal.'],
    ['10. Withdrawals',
     'You may request a withdrawal once per day after completing all evaluations for that day. Each withdrawal is reviewed by our finance team and processed within one business day.'],
    ['11. Item Allocation',
     'Fashion items are allocated to your account based on your membership tier and availability. Higher tiers receive access to a wider selection of premium evaluations.'],
    ['12. Withdrawal Confirmation',
     'Please confirm your wallet address with Customer Support after submitting a withdrawal. Approved withdrawals are paid out the same business day.'],
    ['13. Welcome Credit',
     'The $5 welcome credit is provided once per new account. Pending withdrawals may be cancelled if a member redeems the welcome credit multiple times from duplicate accounts.'],
    ['14. On-Time Submissions',
     'Each evaluation must be submitted within the time limit shown on the screen. Failure to complete evaluations on time without a valid reason may result in account restrictions.'],
    ['15. Platform Integrity',
     'Any attempt to disrupt the platform, exploit loopholes, or interfere with other members will result in permanent suspension and possible legal action.'],
    ['16. Identity Verification',
     'THE OUTNET may request identity verification at any time to comply with anti-money-laundering and anti-terrorism regulations. Members must cooperate with all reasonable verification requests.'],
    ['17. Extension Requests',
     'Members may request a one-time extension on an active evaluation. Repeated extension requests may affect your credibility score.'],
    ['18. Accurate Personal Information',
     'You must provide accurate personal and wallet information when registering and when submitting withdrawals. False information will result in permanent account suspension.'],
    ['19. Compliance & Verification',
     'If requested compliance documentation is not provided in time, withdrawal requests may be declined until verification is complete.'],
    ['20. Feedback & Suggestions',
     'We welcome your feedback. Members may submit suggestions or complaints through Customer Support, and the team will respond within a reasonable time.'],
    ['21. Data Protection',
     'THE OUTNET protects every member\'s personal information in line with our Privacy Policy and applicable data-protection laws.'],
    ['22. Updates to These Terms',
     'THE OUTNET may update these terms from time to time. Material changes will be announced on the platform and communicated to members by email.'],
  ];
@endphp

<div class="on-page on-page-narrow">

    {{-- Page head --}}
    <div class="on-page-head text-center">
        <p class="on-form-eyebrow">Legal</p>
        <h1 class="on-form-heading">Terms of Use</h1>
        <p class="fs-10 text-body-tertiary mb-0">Last updated: January 1, 2025</p>
    </div>

    <p class="mb-5">
        Welcome to THE OUTNET. By creating an account or using our services you agree to the
        rules set out below. These terms govern your use of the platform and protect the
        interests of every member of our community. For any questions, please contact
        <a class="on-text-link" href="{{ route('users.contact') }}">Customer Support</a>.
    </p>

    @foreach ($rules as [$title, $body])
        <div class="mb-4 pb-4" style="border-bottom:1px solid #e5e5e5;">
            <p class="on-card-title mb-2 pb-0 border-0">{{ $title }}</p>
            <p class="fs-10 text-body-tertiary mb-0" style="line-height:1.8;">{{ $body }}</p>
        </div>
    @endforeach

    <blockquote class="text-center my-5 py-4">
        <p class="on-form-heading" style="font-size:1.2rem;font-style:italic;">
            &ldquo;Every member of THE OUTNET is expected to follow the rules above.&rdquo;
        </p>
        <footer class="fs-10 text-body-tertiary text-uppercase" style="letter-spacing:0.16em;">
            THE OUTNET Customer Support &amp; Compliance
        </footer>
    </blockquote>

</div>

@endsection
