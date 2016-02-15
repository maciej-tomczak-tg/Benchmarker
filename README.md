benchmarker
===========

A Symfony project to check how fast site is loading and compared it with competitors.

There are currently 2 reporters. When loading site in comparison exceeds specified ratio its being triggered.
Special configuration is for reporters in config.yml which is pretty self documented

to use email_reporter you have to configure you mailer
to use sms_reporter you have to implement working smsApi, Currently there is some dummy class which you can overwrite or plug yours

You can register your custom reporter, just create a service which implements BenchmarkerBundle\Report\ReporterInterface and tag it with name: benchmarker.report, you can look at service.yml

TODOS:
-Make more unit and functional tests
-Work on look & feel
-Log or do something with failed email and sms delivery