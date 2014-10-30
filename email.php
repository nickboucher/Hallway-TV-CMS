<?php

/* Open IMAP email stream & initialize output variable */
$imap = imap_open("{imap.gmail.com:993/imap/ssl}INBOX", "USERNAME@gmail.com", "PASSWORD");
$data = "";

/* Delete all messages without "announcements" in the subject line */
$numMessages = imap_num_msg($imap);
$result = imap_fetch_overview($imap, "1:{$numMessages}");

foreach ($result as $overview) {
	$subject = strtolower($overview->subject);
	if (strpos($subject,'announcements') === false) {
		imap_delete($imap, $overview->uid, FT_UID);
	}
}
imap_expunge($imap);

/* Extract email body from most recent message, & delete all but latest 2 emails */
$numMessages = imap_num_msg($imap);
for ($i = 1; $i <= $numMessages; $i++) {
	if ($i == $numMessages) {
		$data = imap_fetchbody($imap, $i, 2);
	} elseif ($i < $numMessages - 1) {
		imap_delete($imap, $i);
	}
}
/* Close IMAP stream */
imap_expunge($imap);
imap_close($imap);

/* Return properly encoded and formatted form of extracted data */
$decoded = quoted_printable_decode ($data);
$decoded = strip_tags($decoded, "<p><span><b><u><strong><br>");
$decoded = '<br><br><br><img src="resources/AnnouncementsLogo.png" style="width:100%; display:block;"><br><br><br>' . $decoded . "<br><br><br><br><br><br><br><br><br><br>";

echo utf8_encode($decoded)
?>
