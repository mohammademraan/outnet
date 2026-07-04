@extends('users.layouts.master')

@section('content')

@php
  $faqs = [
    ['cat' => 'Getting Started', 'q' => 'What is this platform and how does it work?',
     'a' => 'This is a task-based earning platform where registered members complete data optimization tasks — rating and reviewing products and services online. Each completed task earns you a commission based on your membership level. You can withdraw your earnings once you have met the minimum withdrawal threshold.'],
    ['cat' => 'Getting Started', 'q' => 'How do I register and get started?',
     'a' => 'Registration is free. Fill in your name, email, phone number, and password, then enter a valid referral code to complete registration. You will start on the entry-level membership which gives you access to tasks immediately.'],
    ['cat' => 'Getting Started', 'q' => 'What is the difference between Normal and Selected tasks?',
     'a' => 'Normal tasks are standard tasks available to all members. Your commission rate depends on your membership level. Selected tasks are premium tasks assigned to members — they carry a fixed higher commission rate regardless of membership tier, making them significantly more valuable.'],
    ['cat' => 'Earnings', 'q' => 'How much commission do I earn per task?',
     'a' => 'Your commission rate depends on your membership level. Normal tasks earn a percentage of the task value. Selected tasks earn a fixed rate. Example: a normal task worth $500 on a mid-level membership earns a set percentage. A selected task worth $2,000 earns the fixed selected rate regardless of your level.'],
    ['cat' => 'Earnings', 'q' => 'How does the referral system work?',
     'a' => 'Each registered member receives a unique referral code. When someone registers using your code and starts completing tasks, you earn a percentage of every commission they receive — passively and automatically. Your referral earnings are credited to your wallet balance and can be withdrawn at any time.'],
    ['cat' => 'Earnings', 'q' => 'When do my earnings get credited?',
     'a' => 'Task commissions are typically credited to your wallet within minutes of task completion. You can track all credits in real time in your History section.'],
    ['cat' => 'Payments', 'q' => 'What is the minimum withdrawal amount?',
     'a' => 'The minimum withdrawal amount is shown on your account profile. There is no maximum daily withdrawal limit for higher membership tiers, though individual transactions are capped for security purposes.'],
    ['cat' => 'Payments', 'q' => 'How long do withdrawals take to process?',
     'a' => 'Most withdrawals are processed within 24 hours of submission on business days. Withdrawals submitted late in the day may be processed on the next business day.'],
    ['cat' => 'Tasks', 'q' => 'How many tasks can I complete per day?',
     'a' => 'Your daily task limit is determined by your membership level. Task limits reset daily. Check your dashboard to see your current limit and how many tasks you have completed today.'],
    ['cat' => 'Tasks', 'q' => 'What happens if I have a pending task?',
     'a' => 'You must complete your current pending task before starting a new one. The system will redirect you to your pending task if you try to generate a new evaluation while one is still in progress.'],
    ['cat' => 'Account', 'q' => 'How do I upgrade my membership?',
     'a' => 'You can upgrade your membership at any time from the Membership section of your dashboard. Membership upgrades are processed after payment verification and activated immediately.'],
    ['cat' => 'Account', 'q' => 'Is my account and money secure?',
     'a' => 'Yes. All sensitive data is encrypted and stored securely. Withdrawal requests require your wallet password as an additional layer of protection. We recommend using a strong, unique password and never sharing your credentials with anyone.'],
  ];
@endphp

<div class="on-page on-page-narrow">

    {{-- Page head --}}
    <div class="on-page-head text-center">
        <p class="on-form-eyebrow">Help Centre</p>
        <h1 class="on-form-heading">Frequently Asked Questions</h1>
    </div>

    {{-- Accordion --}}
    <div class="accordion" id="faqAccordion" style="border-top:1px solid #e5e5e5;">
        @foreach ($faqs as $i => $faq)
            <div class="accordion-item" style="border:none;border-bottom:1px solid #e5e5e5;">
                <h2 class="accordion-header" id="faq-heading-{{ $i }}">
                    <button
                        class="accordion-button {{ $loop->first ? '' : 'collapsed' }}"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#faq-collapse-{{ $i }}"
                        aria-expanded="{{ $loop->first ? 'true' : 'false' }}"
                        aria-controls="faq-collapse-{{ $i }}"
                        style="background:transparent;">
                        <span class="badge bg-dark me-2">{{ $faq['cat'] }}</span>
                        {{ $faq['q'] }}
                    </button>
                </h2>
                <div id="faq-collapse-{{ $i }}"
                     class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}"
                     aria-labelledby="faq-heading-{{ $i }}"
                     data-bs-parent="#faqAccordion">
                    <div class="accordion-body fs-10 text-body-tertiary pt-0" style="line-height:1.8;">
                        {{ $faq['a'] }}
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Still have questions --}}
    <div class="on-card text-center mt-5">
        <span class="fas fa-comments fa-2x text-secondary mb-3 d-block"></span>
        <h2 class="on-form-heading" style="font-size:1.3rem;">Still Have Questions?</h2>
        <p class="fs-10 text-body-tertiary mb-4">Our support team is available 24/7 to help you.</p>
        <a href="{{ route('user.support') }}" class="btn btn-dark px-5">Contact Support</a>
    </div>

</div>

@endsection
