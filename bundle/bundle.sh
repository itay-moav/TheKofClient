#!/bin/bash
rm thekofclient.php
cd ../src
find . -type f -name '*.php' -exec cat {} + >> ../bundle/thekofclient.php
cd ../bundle
sed -i 's/<[?]php namespace TheKof;/\n/g' thekofclient.php
echo -e "<?php namespace TheKof;\n$(cat thekofclient.php)" > thekofclient.php

