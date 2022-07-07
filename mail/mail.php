<?php

 /*----------------------------------------------------------------------------*\
|*  Email settings for sending all emails from your website forms.              *|
 \*============================================================================*/

// Choose here whether to use php mail() function or your SMTP server (recommended) to send the email.
// Use 'smtp' for better reliability, or use 'phpmail' for quick + easy setup with lower reliability.
$emailMethod                = 'smtp'; // REQUIRED value. Options: 'smtp' , 'phpmail'

// Outgoing Server Settings - replace values on the right of the = sign with your own.
// These 3 settings are only required if you choose 'smtp' for emailMethod above.
$outgoingServerAddress      = 'email-smtp.us-east-1.amazonaws.com'; // Consult your hosting provider.
$outgoingServerPort         = '587';                  // Options: '587' , '25' - Consult your hosting provider.
$outgoingServerSecurity     = 'tls';                 // Options: 'ssl' , 'tls' , null - Consult your hosting provider.

// Sending Account Settings - replace these details with an email account held on the SMTP server entered above.
// These 2 settings are only required if you choose 'smtp' for emailMethod above.
$sendingAccountUsername     = 'AKIAIBCFTI4YGHA4ZA3A';
$sendingAccountPassword     = 'Ai8rcm40vBvsvfChujHBB3qY30+MGLczWSZjqfv9tXqr';

// Recipient (To:) Details  - Change this to the email details of who will receive all the emails from the website.
$recipientEmail             = 'letsdothis@thegreatnext.com'; // REQUIRED value.
$recipientName              = 'The Great Next';             // REQUIRED value.

// Email details            - Change these to suit your website needs
$emailSubject               = 'Enquiry for Chadar trek - Social'; // REQUIRED value. Subject of the email that the recipient will see
$websiteName                = 'www.thegreatnext.com';                // REQUIRED value. This is used when a name or email is not collected from the website form


 /*----------------------------------------------------------------------------*\
|*  You do not need to edit anything below this line, the rest is automatic.    *|
 \*============================================================================*/
include('lib/mail_sender.php');

?>