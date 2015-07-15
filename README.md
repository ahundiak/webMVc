## Skooppa OS - webMVc

### Introduction

This is just an experiment currently to play with the idea of a very slim controller for a web MVC framework. The idea is to not build page controllers like most PHP frameworks accomplish, but rather to have the client code strictly in either the Model or the View. It works on the premise that any "controlled" action or rather a model changing action, is either a create, an update or a delete.

One of the other ideas of this type of direction is to get rid of the need for "routing". Ever since I started learning how to program PHP, this part of frameworks, for some reason, just gave me stomach aches. I understand their usage and the reasoning for them, but learning MVC and seeing this routing and mess of controllers makes me still go "WTF?". 

Currently, there is a clock example in the repo, which was made up through [one of the discussions on Sitepoint.com](http://community.sitepoint.com/t/mvc-refactor-take-2/194004/77), which led me to this kind of thinking to begin with. 

I have no idea if this is going to work. This is why the project is purely an experiment. 

### Installation



1. Clone the repo on your server.
2. Composer is setup to be used, but there are no dependencies yet. (just planning for the future)
3. You'll need to setup your server to use the /web/app.php file as the entry point, as the framework is meant to be creating friendly URLs from the start. 

If you got all that working (and sorry if I didn't explain in more detail to help you out, but you should know what you are doing, if you want to use this experiment), you should be able to call up the clock example under http://www.yoursite.com/clock and see the small picklist of cities to call up the time for.

### Things I'd still like to do

1. Add tests.
2. Improve the parameter system. It totally sucks currently and is in the wrong place. It needs to be part of the request.  
3. Get this working with a proper request/ response system like Symfony's HTTPFoundation component.
4. Add a real templating system like Twig.
5. Work on a better example app and pull it out into its own project
6. I am sure more will hit me later.....

At any rate, again, this is totally experimental and not even close to production ready.

If you get it running and would like to help out, feel free to make a PR. 

And as always, Have Fun! :smile:

