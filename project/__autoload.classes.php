<?php
foreach (glob("project/classes/*.php") as $filename) {
    include $filename;
}