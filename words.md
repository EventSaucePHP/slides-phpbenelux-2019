Hi everybody

Thank you for joining me here this morning. I hope you had a lot of fun at the conference yesterday, and I hope you had a little less fun last night, because today we're going to talk about EventSourcing. Which is a somewhat complex topic.


My mame is Frank. I'm a freelance developer based out of Amsterdam. I don't know if I can say exactly where I work, but I work at one of the largest airports in the general Amsterdam area.

When I'm not writing code for money I'm also writing code for free.

I'm the maintainer of Flysytem. If you're a user of Flysystem and want a sticker, please come to me after the talk, or anywhere at this conference, and I'll give a sticker!

Flysystem has was an unexpected huge success,  and allowed me to be involved with many other interesting projects as a freelance developer. And in one of those projects I had the pleasure to work with people that had extensive experience with eventsourcing.

Using event sourcing changed the way I wrote code drastically. Once I had learned the finer distinctions I was able to release new features with more quickly and with more confidence than I had done before. But getting to this point of productivity was not easy. In fact I had been researching event sourcing for quite some time and I just couldn't figure out when to start applying it.

As it turns out, learning event sourcing is pretty hard. And learning it costs time. And mostly that's because there's a lot to learn. It's a technique that's built on top of other techniques, applied in a particular way. So instead of learning one thing, I was learning a lot of things at once.

On top if that, sometimes the individual parts didn't make sense. I couldn't easilly slowly migrate to this new way of working.

And although the individual parts of eventsourcing weren't hard, learning it all and tying it together was pretty difficult.

So while event sourcing may not be hard, it IS complex.

When I saw talks about event sourcing it was pretty easy to follow along with the theory but it was hard get the full picture in my head. When I learned event sourcing it worked a lot better when I saw the code. This inspired me to give this talk.

Today we're going to look at code. A lot of code. We're going to see what event sourcing looks like from the inside out. We'll also be finding out what many of the terms used in event sourcing actually mean.

So these are the terms. Don't worry about reading them all now although I'm pretty sure I can't stop everyone of you to read it anyway, so I'll just quickly grab myself some water.

But let's start with some simple code.