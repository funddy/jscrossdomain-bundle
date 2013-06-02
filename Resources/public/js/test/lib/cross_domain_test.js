// Generated by CoffeeScript 1.6.2
(function() {
  describe("CrossDomain", function() {
    var $;

    $ = {
      get: sinon.spy()
    };
    it("generates default cross domain url", function() {
      var cd;

      cd = new FUNDDY.CrossDomain($);
      cd.get("http://funddy.com/?foo=var");
      return expect($.get.calledWith("/cross-domain?url=http%3A%2F%2Ffunddy.com%2F%3Ffoo%3Dvar")).to.be.ok();
    });
    return it("generates custom cross domain url", function() {
      var cd;

      cd = new FUNDDY.CrossDomain($, "/app.php/cross-domain");
      cd.get("http://funddy.com/?foo=var");
      return expect($.get.calledWith("/app.php/cross-domain?url=http%3A%2F%2Ffunddy.com%2F%3Ffoo%3Dvar")).to.be.ok();
    });
  });

}).call(this);
