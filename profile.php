<?php
header('Content-Type: application/x-apple-aspen-config');
header('Content-Disposition: attachment; filename="install.mobileconfig"');

$name = $_GET['name'] ?? 'App';
$bid = $_GET['bid'] ?? 'com.zeltax.app';
$ipa = $_GET['ipa'] ?? '';
$plistUrl = str_replace('.ipa', '.plist', $ipa);
$itmsLink = "itms-services://?action=download-manifest&url=" . $plistUrl;
$uuid1 = bin2hex(random_bytes(16));
$uuid2 = bin2hex(random_bytes(16));

echo <<<EOD
<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE plist PUBLIC "-//Apple//DTD PLIST 1.0//EN" "http://www.apple.com/DTDs/PropertyList-1.0.dtd">
<plist version="1.0">
<dict>
    <key>PayloadContent</key>
    <array>
        <dict>
            <key>FullScreen</key>
            <true/>
            <key>Label</key>
            <string>$name</string>
            <key>PayloadDescription</key>
            <string>Install $name via Zeltax</string>
            <key>PayloadDisplayName</key>
            <string>$name</string>
            <key>PayloadIdentifier</key>
            <string>com.zeltax.$bid</string>
            <key>PayloadType</key>
            <string>com.apple.webClip.managed</string>
            <key>PayloadUUID</key>
            <string>$uuid1</string>
            <key>PayloadVersion</key>
            <integer>1</integer>
            <key>URL</key>
            <string>$itmsLink</string>
        </dict>
    </array>
    <key>PayloadDisplayName</key>
    <string>Zeltax: $name</string>
    <key>PayloadIdentifier</key>
    <string>com.zeltax.profile</string>
    <key>PayloadType</key>
    <string>Configuration</string>
    <key>PayloadUUID</key>
    <string>$uuid2</string>
    <key>PayloadVersion</key>
    <integer>1</integer>
</dict>
</plist>
EOD;
?>
