<!DOCTYPE html>
<html>
<head>
    <style>
        .email-container { max-width: 600px; margin: auto; padding: 20px; }
        .header { background: #A12C2F; color: white; padding: 20px; text-align: center; }
        .content { padding: 30px; background: #f8f9fa; }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h2>Nouveau message de contact</h2>
        </div>
        
        <div class="content">
            <p><strong>Nom :</strong> {{ $contact->name }}</p>
            <p><strong>Email :</strong> {{ $contact->email }}</p>
            <p><strong>Sujet :</strong> {{ $contact->subject }}</p>
            <p><strong>Message :</strong></p>
            <p>{{ $contact->message }}</p>
        </div>
    </div>
</body>
</html>