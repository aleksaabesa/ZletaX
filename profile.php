<?php
ob_start();
ob_clean();

$name = strip_tags($_GET['name'] ?? 'App');
$bid  = strip_tags($_GET['bid'] ?? 'com.zeltax.app');
$ipa  = $_GET['ipa'] ?? '';
$plistUrl = str_replace('.ipa', '.plist', $ipa);
$itmsLink = "itms-services://?action=download-manifest&url=" . $plistUrl;

// UUID-ები აუცილებელია უნიკალური იყოს
$uuid1 = sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x', mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0x0fff) | 0x4000, mt_rand(0, 0x3fff) | 0x8000, mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff));
$uuid2 = sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x', mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0x0fff) | 0x4000, mt_rand(0, 0x3fff) | 0x8000, mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff));

header('Content-Type: application/x-apple-aspen-config');
header('Content-Disposition: attachment; filename="install.mobileconfig"');

echo '<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE plist PUBLIC "-//Apple//DTD PLIST 1.0//EN" "http://www.apple.com/DTDs/PropertyList-1.0.dtd">
<plist version="1.0">
<dict>
    <key>PayloadContent</key>
    <array>
        <dict>
            <key>FullScreen</key>
            <true/>
            <key>IsRemovable</key>
            <true/>
            <key>Label</key>
            <string>'.$name.'</string>
            <key>PayloadDescription</key>
            <string>Install via Zeltax</string>
            <key>PayloadDisplayName</key>
            <string>'.$name.'</string>
            <key>PayloadIdentifier</key>
            <string>com.zeltax.webclip.'.$uuid1.'</string>
            <key>PayloadType</key>
            <string>com.apple.webClip.managed</string>
            <key>PayloadUUID</key>
            <string>'.$uuid1.'</string>
            <key>PayloadVersion</key>
            <integer>1</integer>
            <key>URL</key>
            <string>'.$itmsLink.'</string>
        </dict>
    </array>
    <key>PayloadDisplayName</key>
    <string>Zeltax Installer</string>
    <key>PayloadIdentifier</key>
    <string>com.zeltax.profile.'.$uuid2.'</string>
    <key>PayloadType</key>
    <string>Configuration</string>
    <key>PayloadUUID</key>
    <string>'.$uuid2.'</string>
    <key>PayloadVersion</key>
    <integer>1</integer>
</dict>
</plist>';
exit;
