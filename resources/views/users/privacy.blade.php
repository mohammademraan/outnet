@extends('users.layouts.master')

@section('content')

@php
  $sections = [
    ['1. Information We Collect',
     'We collect personal information that you voluntarily provide when you register on THE OUTNET, express interest in our products and services, participate in activities on the Site, or otherwise contact us. This may include your name, email address, phone number, shipping address, payment details, and any other information you choose to provide.'],
    ['2. How We Use Your Information',
     'We use the information we collect to operate, maintain, and improve our Site and services, to communicate with you about your orders and account, to process transactions, to send you marketing and promotional communications about our latest collections and exclusive offers, and to comply with legal obligations.'],
    ['3. Cookies and Tracking Technologies',
     'We use cookies and similar tracking technologies to track activity on our Site and store certain information. Cookies help us enhance your shopping experience, analyze usage, and deliver personalized content, style recommendations, and advertisements. You can control the use of cookies through your browser settings.'],
    ['4. Sharing Your Information',
     'We do not sell, trade, or rent your personal information to third parties. We may share information with service providers who assist us in operating our Site, processing payments, or fulfilling orders, so long as those parties agree to keep this information confidential. We may also disclose information if required by law or to protect our rights.'],
    ['5. Data Security',
     'We implement appropriate technical and organizational measures to protect your personal information from unauthorized access, alteration, disclosure, or destruction. However, no method of transmission over the Internet or electronic storage is 100% secure, and we cannot guarantee absolute security.'],
    ['6. Your Rights and Choices',
     'You have the right to access, correct, update, or delete your personal information at any time through your account settings. You may also opt out of receiving marketing communications from us by following the unsubscribe instructions in our emails or by contacting us directly.'],
    ['7. Third-Party Links',
     'Our Site may contain links to third-party websites, including social media platforms and partner brands. We are not responsible for the privacy practices or the content of such third-party sites. We encourage you to read the privacy policies of every website you visit.'],
    ['8. Children\'s Privacy',
     'THE OUTNET does not knowingly collect or solicit personal information from children under the age of 16. If we learn that we have collected personal information from a child under age 16, we will delete that information as quickly as possible. Parents or guardians who believe their child has provided us with personal information may contact us to request its removal.'],
    ['9. Changes to This Privacy Policy',
     'We may update this Privacy Policy from time to time to reflect changes in our practices or for other operational, legal, or regulatory reasons. We will notify you of any material changes by posting the updated Privacy Policy on this page. Your continued use of the Site after any changes constitutes your acceptance of the revised policy.'],
    ['10. Contact Us',
     'If you have any questions or concerns about this Privacy Policy or how we handle your personal data, please reach out to our dedicated support team through the Contact page.'],
  ];
@endphp

<div class="on-page on-page-narrow">

    {{-- Page head --}}
    <div class="on-page-head text-center">
        <p class="on-form-eyebrow">Legal</p>
        <h1 class="on-form-heading">Privacy Policy</h1>
        <p class="fs-10 text-body-tertiary mb-0">Last updated: January 1, 2025</p>
    </div>

    <p class="mb-5">
        At THE OUTNET, your privacy is a priority. This Privacy Policy explains how we collect,
        use, and protect your personal information when you visit our site or engage with our
        services. By using our Site, you agree to the practices described below.
    </p>

    @foreach ($sections as [$title, $body])
        <div class="mb-4 pb-4" style="border-bottom:1px solid #e5e5e5;">
            <p class="on-card-title mb-2 pb-0 border-0">{{ $title }}</p>
            <p class="fs-10 text-body-tertiary mb-0" style="line-height:1.8;">{{ $body }}</p>
        </div>
    @endforeach

    <blockquote class="text-center my-5 py-4">
        <p class="on-form-heading" style="font-size:1.2rem;font-style:italic;">
            &ldquo;Fashion is built on trust &mdash; and so is our relationship with your data.&rdquo;
        </p>
        <footer class="fs-10 text-body-tertiary text-uppercase" style="letter-spacing:0.16em;">
            THE OUTNET Privacy &amp; Compliance Team
        </footer>
    </blockquote>

</div>

@endsection
