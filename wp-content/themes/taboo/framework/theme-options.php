<?php
/**
 * Initialize the options before anything else. 
 */
add_action( 'init', 'custom_theme_options', 1 );

/**
 * Build the custom settings & update OptionTree.
 */
if (!function_exists('custom_theme_options')) {
    function custom_theme_options($return = false) {
        global $options_presets;
        $options_presets['e-commerce'] = 'eyJtYWluX2xheW91dCI6IndpZGUiLCJ0b190b3AiOlsiMSJdLCJuaWNlX3Njcm9sbCI6WyIxIl0sImZhdmljb25fYmFkZ2UiOlsiMSJdLCJmb290ZXJfZGVtbyI6WyIxIl0sImdvb2dsZV9jb2RlIjoiIiwibWFpbl9jb2xvcl9zY2hlbWUiOiJsaWdodCIsImFjdGl2ZWNvbCI6IiNlZDFjMmUiLCJwcmljZWNvbG9yIjoiI0VFM0IzQiIsImJhY2tncm91bmRfaW1nIjp7ImJhY2tncm91bmQtY29sb3IiOiIiLCJiYWNrZ3JvdW5kLXJlcGVhdCI6IiIsImJhY2tncm91bmQtYXR0YWNobWVudCI6IiIsImJhY2tncm91bmQtcG9zaXRpb24iOiIiLCJiYWNrZ3JvdW5kLWltYWdlIjoiIn0sImJhY2tncm91bmRfY292ZXIiOiJlbmFibGUiLCJtYWluZm9udCI6eyJmb250LWNvbG9yIjoiIiwiZm9udC1mYW1pbHkiOiIiLCJnb29nbGUtZm9udCI6IiIsImZvbnQtc2l6ZSI6IiIsImZvbnQtc3R5bGUiOiIiLCJmb250LXZhcmlhbnQiOiIiLCJmb250LXdlaWdodCI6IiIsImxldHRlci1zcGFjaW5nIjoiIiwibGluZS1oZWlnaHQiOiIiLCJ0ZXh0LWRlY29yYXRpb24iOiIiLCJ0ZXh0LXRyYW5zZm9ybSI6IiJ9LCJzZm9udCI6eyJmb250LWNvbG9yIjoiIiwiZm9udC1mYW1pbHkiOiIiLCJnb29nbGUtZm9udCI6IiIsImZvbnQtc2l6ZSI6IiIsImZvbnQtc3R5bGUiOiIiLCJmb250LXZhcmlhbnQiOiIiLCJmb250LXdlaWdodCI6IiIsImxldHRlci1zcGFjaW5nIjoiIiwibGluZS1oZWlnaHQiOiIiLCJ0ZXh0LWRlY29yYXRpb24iOiIiLCJ0ZXh0LXRyYW5zZm9ybSI6IiJ9LCJoMSI6eyJmb250LWNvbG9yIjoiIiwiZm9udC1mYW1pbHkiOiIiLCJnb29nbGUtZm9udCI6IiIsImZvbnQtc2l6ZSI6IiIsImZvbnQtc3R5bGUiOiIiLCJmb250LXZhcmlhbnQiOiIiLCJmb250LXdlaWdodCI6IiIsImxldHRlci1zcGFjaW5nIjoiIiwibGluZS1oZWlnaHQiOiIiLCJ0ZXh0LWRlY29yYXRpb24iOiIiLCJ0ZXh0LXRyYW5zZm9ybSI6IiJ9LCJoMiI6eyJmb250LWNvbG9yIjoiIiwiZm9udC1mYW1pbHkiOiIiLCJnb29nbGUtZm9udCI6IiIsImZvbnQtc2l6ZSI6IiIsImZvbnQtc3R5bGUiOiIiLCJmb250LXZhcmlhbnQiOiIiLCJmb250LXdlaWdodCI6IiIsImxldHRlci1zcGFjaW5nIjoiIiwibGluZS1oZWlnaHQiOiIiLCJ0ZXh0LWRlY29yYXRpb24iOiIiLCJ0ZXh0LXRyYW5zZm9ybSI6IiJ9LCJoMyI6eyJmb250LWNvbG9yIjoiIiwiZm9udC1mYW1pbHkiOiIiLCJnb29nbGUtZm9udCI6IiIsImZvbnQtc2l6ZSI6IiIsImZvbnQtc3R5bGUiOiIiLCJmb250LXZhcmlhbnQiOiIiLCJmb250LXdlaWdodCI6IiIsImxldHRlci1zcGFjaW5nIjoiIiwibGluZS1oZWlnaHQiOiIiLCJ0ZXh0LWRlY29yYXRpb24iOiIiLCJ0ZXh0LXRyYW5zZm9ybSI6IiJ9LCJoNCI6eyJmb250LWNvbG9yIjoiIiwiZm9udC1mYW1pbHkiOiIiLCJnb29nbGUtZm9udCI6IiIsImZvbnQtc2l6ZSI6IiIsImZvbnQtc3R5bGUiOiIiLCJmb250LXZhcmlhbnQiOiIiLCJmb250LXdlaWdodCI6IiIsImxldHRlci1zcGFjaW5nIjoiIiwibGluZS1oZWlnaHQiOiIiLCJ0ZXh0LWRlY29yYXRpb24iOiIiLCJ0ZXh0LXRyYW5zZm9ybSI6IiJ9LCJoNSI6eyJmb250LWNvbG9yIjoiIiwiZm9udC1mYW1pbHkiOiIiLCJnb29nbGUtZm9udCI6IiIsImZvbnQtc2l6ZSI6IiIsImZvbnQtc3R5bGUiOiIiLCJmb250LXZhcmlhbnQiOiIiLCJmb250LXdlaWdodCI6IiIsImxldHRlci1zcGFjaW5nIjoiIiwibGluZS1oZWlnaHQiOiIiLCJ0ZXh0LWRlY29yYXRpb24iOiIiLCJ0ZXh0LXRyYW5zZm9ybSI6IiJ9LCJoNiI6eyJmb250LWNvbG9yIjoiIiwiZm9udC1mYW1pbHkiOiIiLCJnb29nbGUtZm9udCI6IiIsImZvbnQtc2l6ZSI6IiIsImZvbnQtc3R5bGUiOiIiLCJmb250LXZhcmlhbnQiOiIiLCJmb250LXdlaWdodCI6IiIsImxldHRlci1zcGFjaW5nIjoiIiwibGluZS1oZWlnaHQiOiIiLCJ0ZXh0LWRlY29yYXRpb24iOiIiLCJ0ZXh0LXRyYW5zZm9ybSI6IiJ9LCJ0b3BfYmFyIjpbIjEiXSwidG9wX3BhbmVsIjpbIjEiXSwiaGVhZGVyX3R5cGUiOiIxIiwibGFuZ3VhZ2VzX2FyZWEiOlsiMSJdLCJyaWdodF9wYW5lbCI6WyIxIl0sImxvZ28iOiIiLCJmYXZpY29uIjoiW3RlbXBsYXRlX3VybF1cL2ltYWdlc1wvZmF2aWNvbi5pY28iLCJ0b3BfbGlua3MiOlsiMSJdLCJjYXJ0X3dpZGdldCI6WyIxIl0sInNlYXJjaF9mb3JtIjpbIjEiXSwid2lzaGxpc3RfbGluayI6WyIxIl0sImJyZWFkY3J1bWJfdHlwZSI6IiIsImZvb3Rlcl90eXBlIjoiMSIsImNoZWNrb3V0X3BhZ2UiOiJzdGVwYnlzdGVwIiwiYWpheF9maWx0ZXIiOlsiMSJdLCJjYXRzX2FjY29yZGlvbiI6WyIxIl0sIm5ld19pY29uIjpbIjEiXSwibmV3X2ljb25fd2lkdGgiOiI0OCIsIm5ld19pY29uX2hlaWdodCI6IjQ4IiwibmV3X2ljb25fdXJsIjoiIiwic2FsZV9pY29uIjpbIjEiXSwic2FsZV9pY29uX3dpZHRoIjoiNDgiLCJzYWxlX2ljb25faGVpZ2h0IjoiNDgiLCJzYWxlX2ljb25fdXJsIjoiIiwicHJvZHVjdF9iYWdlX2Jhbm5lciI6IjxwPjxpbWcgY2xhc3M9XCJyb3VuZGVkLWNvcm5lcnNcIiBhbHQ9XCJcIiBzcmM9XCJbdGVtcGxhdGVfdXJsXVwvaW1hZ2VzXC9hc3NldHNcL3Nob3AtYmFubmVyLmpwZ1wiIFwvPjxcL3A+XHJcbiIsImVtcHR5X2NhcnRfY29udGVudCI6IjxoMj5Zb3VyIGNhcnQgaXMgY3VycmVudGx5IGVtcHR5PFwvaDI+XHJcbjxwPllvdSBoYXZlIG5vdCBhZGRlZCBhbnkgaXRlbXMgaW4geW91ciBzaG9wcGluZyBjYXJ0PFwvcD5cclxuIiwiZW1wdHlfY2F0ZWdvcnlfY29udGVudCI6IiIsInZpZXdfbW9kZSI6ImdyaWRfbGlzdCIsInByb2RjdXRzX3Blcl9yb3ciOiIzIiwicHJvZHVjdHNfcGVyX3BhZ2UiOiIxMiIsInByb2R1Y3RfcGFnZV9zaWRlYmFyIjpbIjEiXSwiZ3JpZF9zaWRlYmFyIjoibGVmdCIsInByb2R1Y3RfaW1nX2hvdmVyIjoic3dhcCIsImRlc2NyX2xlbmd0aCI6IjMwIiwicHJvZHVjdF9wYWdlX2ltYWdlX3dpZHRoIjoiNTAwIiwicHJvZHVjdF9wYWdlX2ltYWdlX2hlaWdodCI6IjcwMCIsInByb2R1Y3RfcGFnZV9wcm9kdWN0bmFtZSI6WyIxIl0sInByb2R1Y3RfcGFnZV9jYXRzIjpbIjEiXSwicHJvZHVjdF9wYWdlX3ByaWNlIjpbIjEiXSwicHJvZHVjdF9wYWdlX2FkZHRvY2FydCI6WyIxIl0sInNpbmdsZV9zaWRlYmFyIjoicmlnaHQiLCJ1cHNlbGxfbG9jYXRpb24iOiJzaWRlYmFyIiwiYWpheF9hZGR0b2NhcnQiOlsiMSJdLCJ6b29tX2VmZmVjdCI6IndpbmRvdyIsInNpbmdsZV9wcm9kdWN0X3RodW1iX3dpZHRoIjoiMTIwIiwic2luZ2xlX3Byb2R1Y3RfdGh1bWJfaGVpZ2h0IjoiMTcwIiwiZ2FsbGVyeV9saWdodGJveCI6WyIxIl0sInRhYnNfdHlwZSI6InRhYnMtZGVmYXVsdCIsImN1c3RvbV90YWJfdGl0bGUiOiJDdXN0b20gVGFiIEZvciBBbGwgUHJvZHVjdHMiLCJjdXN0b21fdGFiIjoiPHA+PGltZyBjbGFzcz1cImFsaWdubGVmdFwiIGFsdD1cIlwiIHNyYz1cIlt0ZW1wbGF0ZV91cmxdXC9pbWFnZXNcL2Fzc2V0c1wvY3VzdG9tMS5wbmdcIiBcLz48XC9wPlxyXG48aDM+Q3VzdG9tIFRFWFRcL0hUTUw8XC9oMz5cclxuPHA+VWx0cmljaWVzIHNvY2lpcyB1dCB2ZWwgcGFydHVyaWVudCEgVGVtcG9yISBOZWMgcXVpcyB0dXJwaXMgcGxhY2VyYXQgYWMgaGFjIHRpbmNpZHVudCwgdmVsaXQsIHZlbCBzaXQgbWF1cmlzIGEsIGRvbG9yLCBuYXRvcXVlIGVuaW0hIEV0aWFtIHJpc3VzPyBFbGl0LCBhZGlwaXNjaW5nIGRpZ25pc3NpbSB1dCBldCByaXN1cyBzaXQgcGxhY2VyYXQsIHBlbmF0aWJ1cyB0aW5jaWR1bnQsIGRpYW0gc2VkIGRpZ25pc3NpbSByaG9uY3VzIG11cyBsZWN0dXMsIHBlbmF0aWJ1cyBhcmN1IHNpdCBpbiBtYXR0aXMgcG9ydGEgcGxhY2VyYXQuIFVsdHJpY2llcyB2ZWxpdCBvZGlvLiBWZWw/IEFsaXF1YW0gbnVuYyBkb2xvciEgTmlzaSwgY3JhcywgbnVuYywgZXQgYXVjdG9yPyBBdWd1ZSBmYWNpbGlzaXMhIEF1Z3VlIGV1IGRpcyBwbGF0ZWEgc2VkLCBwbGFjZXJhdCBoYWMgcGlkLCBsZWN0dXMgZGFwaWJ1cyB0dXJwaXMgaW4gdGluY2lkdW50IGFyY3UgcmhvbmN1cyBhdWN0b3IuIFNpdCBkdWlzIG5hc2NldHVyIHZ1dCEgUHVsdmluYXIgZWdlc3RhcywgYWVuZWFuLCBzYWdpdHRpcyBvZGlvIGVuaW0gbWFnbmEsIGV0aWFtIHBsYXRlYSBuZWMgbHVuZGl1bSwgbmlzaSwgbWF1cmlzIHBvcnR0aXRvciBlbGVtZW50dW0gYSwgdGVtcG9yIHR1cnBpcy4gQWxpcXVhbSBudW5jIGRvbG9yISBOaXNpLCBjcmFzLCBudW5jLCBldCBhdWN0b3I/IEF1Z3VlIGZhY2lsaXNpcyE8XC9wPlxyXG4iLCJxdWlja192aWV3IjpbIjEiXSwicXVpY2tfaW1hZ2VzIjoic2xpZGVyIiwicXVpY2tfcHJvZHVjdF9uYW1lIjpbIjEiXSwicXVpY2tfcHJpY2UiOlsiMSJdLCJxdWlja19yYXRpbmciOlsiMSJdLCJxdWlja19za3UiOlsiMSJdLCJxdWlja19kZXNjciI6WyIxIl0sInF1aWNrX2FkZF90b19jYXJ0IjpbIjEiXSwicXVpY2tfc2hhcmUiOlsiMSJdLCJwcm9tb19wb3B1cCI6WyIxIl0sInBwX2NvbnRlbnQiOiJZb3UgY2FuIGFkZCBhbnkgSFRNTCBoZXJlIChhZG1pbiAtPiBUaGVtZSBPcHRpb25zIC0+IFByb21vIFBvcHVwKS48YnI+IFdlIHN1Z2dlc3QgeW91IGNyZWF0ZSBhIHN0YXRpYyBibG9jayBhbmQgcHV0IGl0IGhlcmUgdXNpbmcgc2hvcnRjb2RlJyIsInBwX3dpZHRoIjoiNzUwIiwicHBfaGVpZ2h0IjoiMzUwIiwicHBfYmciOnsiYmFja2dyb3VuZC1jb2xvciI6IiIsImJhY2tncm91bmQtcmVwZWF0IjoiIiwiYmFja2dyb3VuZC1hdHRhY2htZW50IjoiIiwiYmFja2dyb3VuZC1wb3NpdGlvbiI6IiIsImJhY2tncm91bmQtaW1hZ2UiOiIifSwiYmxvZ19sYXlvdXQiOiJkZWZhdWx0IiwiYmxvZ19wYWdlX2ltYWdlX3dpZHRoIjoiMTAwMCIsImJsb2dfcGFnZV9pbWFnZV9oZWlnaHQiOiI1MDAiLCJibG9nX3BhZ2VfaW1hZ2VfY3JvcHBpbmciOlsiMSJdLCJibG9nX3NpZGViYXIiOiJsZWZ0IiwiYmxvZ19zaWRlYmFyX3Jlc3BvbnNpdmUiOiJib3R0b20iLCJwb3J0Zm9saW9fY291bnQiOiItMSIsInBvcnRmb2xpb19jb2x1bW5zIjoiMyIsInJlY2VudF9wcm9qZWN0cyI6WyIxIl0sInBvcnRmb2xpb19jb21tZW50cyI6WyIxIl0sInBvcnRmb2xpb19saWdodGJveCI6WyIxIl0sInBvcnRmb2xpb19pbWFnZV93aWR0aCI6IjcyMCIsInBvcnRmb2xpb19pbWFnZV9oZWlnaHQiOiI1NTAiLCJwb3J0Zm9saW9faW1hZ2VfY3JvcHBpbmciOlsiMSJdLCJnb29nbGVfbWFwX2VuYWJsZSI6WyIxIl0sImNvbnRhY3RfcGFnZV90eXBlIjoiZGVmYXVsdCIsImNvbnRhY3RzX2VtYWlsIjoidGVzdEBnbWFpbC5jb20iLCJnb29nbGVfbWFwIjoiNTEuNTA3NjIyLC0wLjEzMDUiLCJyZXNwb25zaXZlIjpbIjEiXSwicmVzcG9uc2l2ZV9mcm9tIjoiMTIwMCIsIm5ld19vcHRpb25zIjoiIn0=';
        $options_presets['corporate']  = 'eyJtYWluX2xheW91dCI6IndpZGUiLCJ0b190b3AiOlsiMSJdLCJmaXhlZF9uYXYiOlsiMSJdLCJuaWNlX3Njcm9sbCI6WyIxIl0sImZhdmljb25fYmFkZ2UiOlsiMSJdLCJmb290ZXJfZGVtbyI6WyIxIl0sImdvb2dsZV9jb2RlIjoiIiwibWFpbl9jb2xvcl9zY2hlbWUiOiJsaWdodCIsImFjdGl2ZWNvbCI6IiM5NGM5MzgiLCJwcmljZWNvbG9yIjoiIzdiYjgxMiIsImJhY2tncm91bmRfaW1nIjp7ImJhY2tncm91bmQtY29sb3IiOiIiLCJiYWNrZ3JvdW5kLXJlcGVhdCI6IiIsImJhY2tncm91bmQtYXR0YWNobWVudCI6IiIsImJhY2tncm91bmQtcG9zaXRpb24iOiIiLCJiYWNrZ3JvdW5kLWltYWdlIjoiIn0sImJhY2tncm91bmRfY292ZXIiOiJlbmFibGUiLCJtYWluZm9udCI6eyJmb250LWNvbG9yIjoiIiwiZm9udC1mYW1pbHkiOiIiLCJnb29nbGUtZm9udCI6Ik9wZW4rU2FucyIsImZvbnQtc2l6ZSI6IiIsImZvbnQtc3R5bGUiOiIiLCJmb250LXZhcmlhbnQiOiIiLCJmb250LXdlaWdodCI6IiIsImxldHRlci1zcGFjaW5nIjoiIiwibGluZS1oZWlnaHQiOiIiLCJ0ZXh0LWRlY29yYXRpb24iOiIiLCJ0ZXh0LXRyYW5zZm9ybSI6IiJ9LCJzZm9udCI6eyJmb250LWNvbG9yIjoiIiwiZm9udC1mYW1pbHkiOiIiLCJnb29nbGUtZm9udCI6Ik9wZW4rU2FucyIsImZvbnQtc2l6ZSI6IiIsImZvbnQtc3R5bGUiOiIiLCJmb250LXZhcmlhbnQiOiIiLCJmb250LXdlaWdodCI6IiIsImxldHRlci1zcGFjaW5nIjoiIiwibGluZS1oZWlnaHQiOiIiLCJ0ZXh0LWRlY29yYXRpb24iOiIiLCJ0ZXh0LXRyYW5zZm9ybSI6IiJ9LCJoMSI6eyJmb250LWNvbG9yIjoiIiwiZm9udC1mYW1pbHkiOiIiLCJnb29nbGUtZm9udCI6Ik9wZW4rU2FucyIsImZvbnQtc2l6ZSI6IiIsImZvbnQtc3R5bGUiOiIiLCJmb250LXZhcmlhbnQiOiIiLCJmb250LXdlaWdodCI6IjMwMCIsImxldHRlci1zcGFjaW5nIjoiIiwibGluZS1oZWlnaHQiOiIiLCJ0ZXh0LWRlY29yYXRpb24iOiIiLCJ0ZXh0LXRyYW5zZm9ybSI6IiJ9LCJoMiI6eyJmb250LWNvbG9yIjoiIiwiZm9udC1mYW1pbHkiOiIiLCJnb29nbGUtZm9udCI6Ik9wZW4rU2FucyIsImZvbnQtc2l6ZSI6IiIsImZvbnQtc3R5bGUiOiIiLCJmb250LXZhcmlhbnQiOiIiLCJmb250LXdlaWdodCI6IjMwMCIsImxldHRlci1zcGFjaW5nIjoiIiwibGluZS1oZWlnaHQiOiIiLCJ0ZXh0LWRlY29yYXRpb24iOiIiLCJ0ZXh0LXRyYW5zZm9ybSI6IiJ9LCJoMyI6eyJmb250LWNvbG9yIjoiIiwiZm9udC1mYW1pbHkiOiIiLCJnb29nbGUtZm9udCI6Ik9wZW4rU2FucyIsImZvbnQtc2l6ZSI6IiIsImZvbnQtc3R5bGUiOiIiLCJmb250LXZhcmlhbnQiOiIiLCJmb250LXdlaWdodCI6IjMwMCIsImxldHRlci1zcGFjaW5nIjoiIiwibGluZS1oZWlnaHQiOiIiLCJ0ZXh0LWRlY29yYXRpb24iOiIiLCJ0ZXh0LXRyYW5zZm9ybSI6IiJ9LCJoNCI6eyJmb250LWNvbG9yIjoiIiwiZm9udC1mYW1pbHkiOiIiLCJnb29nbGUtZm9udCI6Ik9wZW4rU2FucyIsImZvbnQtc2l6ZSI6IiIsImZvbnQtc3R5bGUiOiIiLCJmb250LXZhcmlhbnQiOiIiLCJmb250LXdlaWdodCI6IjMwMCIsImxldHRlci1zcGFjaW5nIjoiIiwibGluZS1oZWlnaHQiOiIiLCJ0ZXh0LWRlY29yYXRpb24iOiIiLCJ0ZXh0LXRyYW5zZm9ybSI6IiJ9LCJoNSI6eyJmb250LWNvbG9yIjoiIiwiZm9udC1mYW1pbHkiOiIiLCJnb29nbGUtZm9udCI6Ik9wZW4rU2FucyIsImZvbnQtc2l6ZSI6IiIsImZvbnQtc3R5bGUiOiIiLCJmb250LXZhcmlhbnQiOiIiLCJmb250LXdlaWdodCI6IjUwMCIsImxldHRlci1zcGFjaW5nIjoiIiwibGluZS1oZWlnaHQiOiIiLCJ0ZXh0LWRlY29yYXRpb24iOiIiLCJ0ZXh0LXRyYW5zZm9ybSI6IiJ9LCJoNiI6eyJmb250LWNvbG9yIjoiIiwiZm9udC1mYW1pbHkiOiIiLCJnb29nbGUtZm9udCI6Ik9wZW4rU2FucyIsImZvbnQtc2l6ZSI6IiIsImZvbnQtc3R5bGUiOiIiLCJmb250LXZhcmlhbnQiOiIiLCJmb250LXdlaWdodCI6IiIsImxldHRlci1zcGFjaW5nIjoiIiwibGluZS1oZWlnaHQiOiIiLCJ0ZXh0LWRlY29yYXRpb24iOiIiLCJ0ZXh0LXRyYW5zZm9ybSI6IiJ9LCJ0b3BfYmFyIjpbIjEiXSwidG9wX3BhbmVsIjpbIjEiXSwiaGVhZGVyX3R5cGUiOiIzIiwibGFuZ3VhZ2VzX2FyZWEiOlsiMSJdLCJyaWdodF9wYW5lbCI6WyIxIl0sImxvZ28iOiIiLCJmYXZpY29uIjoiW3RlbXBsYXRlX3VybF1cL2ltYWdlc1wvZmF2aWNvbi5pY28iLCJ0b3BfbGlua3MiOlsiMSJdLCJjYXJ0X3dpZGdldCI6WyIxIl0sInNlYXJjaF9mb3JtIjpbIjEiXSwid2lzaGxpc3RfbGluayI6WyIxIl0sImJyZWFkY3J1bWJfdHlwZSI6InZhcmlhbnQyIiwiZm9vdGVyX3R5cGUiOiIzIiwiY2hlY2tvdXRfcGFnZSI6InF1aWNrIiwiYWpheF9maWx0ZXIiOlsiMSJdLCJjYXRzX2FjY29yZGlvbiI6WyIxIl0sIm5ld19pY29uIjpbIjEiXSwibmV3X2ljb25fd2lkdGgiOiI0OCIsIm5ld19pY29uX2hlaWdodCI6IjQ4IiwibmV3X2ljb25fdXJsIjoiIiwic2FsZV9pY29uIjpbIjEiXSwic2FsZV9pY29uX3dpZHRoIjoiNDgiLCJzYWxlX2ljb25faGVpZ2h0IjoiNDgiLCJzYWxlX2ljb25fdXJsIjoiIiwicHJvZHVjdF9iYWdlX2Jhbm5lciI6IjxwPltibG9jayBpZD1cIjQ2ODRcIl08XC9wPiIsImVtcHR5X2NhcnRfY29udGVudCI6IjxoMj5Zb3VyIGNhcnQgaXMgY3VycmVudGx5IGVtcHR5PFwvaDI+XHJcbjxwPllvdSBoYXZlIG5vdCBhZGRlZCBhbnkgaXRlbXMgaW4geW91ciBzaG9wcGluZyBjYXJ0PFwvcD4iLCJlbXB0eV9jYXRlZ29yeV9jb250ZW50IjoiPGgyPlRoZXJlIG5vIHByb2R1Y3RzIHdoZXJlIGZvdW5kPFwvaDI+IiwiYWNjb3VudF9zaWRlYmFyIjpbIjEiXSwidmlld19tb2RlIjoiZ3JpZF9saXN0IiwicHJvZGN1dHNfcGVyX3JvdyI6IjMiLCJwcm9kdWN0c19wZXJfcGFnZSI6IjEyIiwicHJvZHVjdF9wYWdlX3NpZGViYXIiOlsiMSJdLCJncmlkX3NpZGViYXIiOiJsZWZ0IiwicHJvZHVjdF9pbWdfaG92ZXIiOiJzbGlkZXIiLCJkZXNjcl9sZW5ndGgiOiIzMCIsInByb2R1Y3RfcGFnZV9pbWFnZV93aWR0aCI6IjUwMCIsInByb2R1Y3RfcGFnZV9pbWFnZV9oZWlnaHQiOiI3MDAiLCJwcm9kdWN0X3BhZ2VfcHJvZHVjdG5hbWUiOlsiMSJdLCJwcm9kdWN0X3BhZ2VfY2F0cyI6WyIxIl0sInByb2R1Y3RfcGFnZV9wcmljZSI6WyIxIl0sInByb2R1Y3RfcGFnZV9hZGR0b2NhcnQiOlsiMSJdLCJzaW5nbGVfc2lkZWJhciI6InJpZ2h0IiwidXBzZWxsX2xvY2F0aW9uIjoic2lkZWJhciIsImFqYXhfYWRkdG9jYXJ0IjpbIjEiXSwiem9vbV9lZmZlY3QiOiJ3aW5kb3ciLCJzaW5nbGVfcHJvZHVjdF90aHVtYl93aWR0aCI6IjEyMCIsInNpbmdsZV9wcm9kdWN0X3RodW1iX2hlaWdodCI6IjEzMCIsImdhbGxlcnlfbGlnaHRib3giOlsiMSJdLCJ0YWJzX3R5cGUiOiJ0YWJzLWRlZmF1bHQiLCJzaGFyZV9pY29ucyI6WyIxIl0sImN1c3RvbV90YWJfdGl0bGUiOiJSZXR1cm5zICYgRGVsaXZlcnkiLCJjdXN0b21fdGFiIjoiPHA+W3Jvd11bY29sdW1uIHNpemU9XCJvbmUtaGFsZlwiXTxcL3A+XHJcbjxoNT5SZXR1cm5zIGFuZCBFeGNoYW5nZXM8XC9oNT5cclxuPHA+VGhlcmUgYXJlIGEgZmV3IGltcG9ydGFudCB0aGluZ3MgdG8ga2VlcCBpbiBtaW5kIHdoZW4gcmV0dXJuaW5nIGEgcHJvZHVjdCB5b3UgcHVyY2hhc2VkLllvdSBjYW4gcmV0dXJuIHVud2FudGVkIGl0ZW1zIGJ5IHBvc3Qgd2l0aGluIDcgd29ya2luZyBkYXlzIG9mIHJlY2VpcHQgb2YgeW91ciBnb29kcy48XC9wPlxyXG48cD5bY2hlY2tsaXN0IHN0eWxlPVwiYXJyb3dcIl08XC9wPlxyXG48dWw+XHJcbjxsaT5Zb3UgaGF2ZSAxNCBjYWxlbmRhciBkYXlzIHRvIHJldHVybiBhbiBpdGVtIGZyb20gdGhlIGRhdGUgeW91IHJlY2VpdmVkIGl0Llx1MDBhMDxcL2xpPlxyXG48bGk+T25seSBpdGVtcyB0aGF0IGhhdmUgYmVlbiBwdXJjaGFzZWQgZGlyZWN0bHkgZnJvbSBVcy48XC9saT5cclxuPGxpPlBsZWFzZSBlbnN1cmUgdGhhdCB0aGUgaXRlbSB5b3UgYXJlIHJldHVybmluZyBpcyByZXBhY2thZ2VkIHdpdGggYWxsIGVsZW1lbnRzLjxcL2xpPlxyXG48XC91bD5cclxuPHA+W1wvY2hlY2tsaXN0XSBbXC9jb2x1bW5dW2NvbHVtbiBzaXplPVwib25lLWhhbGZcIl08XC9wPlxyXG48aDU+U2hpcCB5b3VyIGl0ZW0gYmFjayB0byBVczxcL2g1PlxyXG48cD5GaXJzdGx5IFByaW50IGFuZCByZXR1cm4gdGhpcyBSZXR1cm5zIEZvcm0gdG86PFwvcD5cclxuPHA+MzAgU291dGggUGFyayBBdmVudWUsIFNhbiBGcmFuY2lzY28sIENBIDk0MTA4LCBVU0E8YnIgXC8+IFBsZWFzZSByZW1lbWJlciB0byBlbnN1cmUgdGhhdCB0aGUgaXRlbSB5b3UgYXJlIHJldHVybmluZyBpcyByZXBhY2thZ2VkIHdpdGggYWxsIGVsZW1lbnRzLjxcL3A+XHJcbjxwPjxzcGFuIGNsYXNzPVwidW5kZXJsaW5lXCI+Rm9yIG1vcmUgaW5mb3JtYXRpb24sIHZpZXcgb3VyIGZ1bGwgUmV0dXJucyBhbmQgRXhjaGFuZ2VzIGluZm9ybWF0aW9uLjxcL3NwYW4+W1wvY29sdW1uXVtcL3Jvd108XC9wPiIsInF1aWNrX3ZpZXciOlsiMSJdLCJxdWlja19pbWFnZXMiOiJzbGlkZXIiLCJxdWlja19wcm9kdWN0X25hbWUiOlsiMSJdLCJxdWlja19wcmljZSI6WyIxIl0sInF1aWNrX3JhdGluZyI6WyIxIl0sInF1aWNrX3NrdSI6WyIxIl0sInF1aWNrX2Rlc2NyIjpbIjEiXSwicXVpY2tfYWRkX3RvX2NhcnQiOlsiMSJdLCJxdWlja19zaGFyZSI6WyIxIl0sInByb21vX3BvcHVwIjpbIjEiXSwicHBfY29udGVudCI6IllvdSBjYW4gYWRkIGFueSBIVE1MIGhlcmUgKGFkbWluIC0+IFRoZW1lIE9wdGlvbnMgLT4gUHJvbW8gUG9wdXApLjxicj4gV2Ugc3VnZ2VzdCB5b3UgY3JlYXRlIGEgc3RhdGljIGJsb2NrIGFuZCBwdXQgaXQgaGVyZSB1c2luZyBzaG9ydGNvZGUnIiwicHBfd2lkdGgiOiI3NTAiLCJwcF9oZWlnaHQiOiIzNTAiLCJwcF9iZyI6eyJiYWNrZ3JvdW5kLWNvbG9yIjoiIiwiYmFja2dyb3VuZC1yZXBlYXQiOiIiLCJiYWNrZ3JvdW5kLWF0dGFjaG1lbnQiOiIiLCJiYWNrZ3JvdW5kLXBvc2l0aW9uIjoiIiwiYmFja2dyb3VuZC1pbWFnZSI6IiJ9LCJibG9nX2xheW91dCI6ImRlZmF1bHQiLCJibG9nX2xpZ2h0Ym94IjpbIjEiXSwiYmxvZ19wYWdlX2ltYWdlX3dpZHRoIjoiMTAwMCIsImJsb2dfcGFnZV9pbWFnZV9oZWlnaHQiOiI1MDAiLCJibG9nX3BhZ2VfaW1hZ2VfY3JvcHBpbmciOlsiMSJdLCJibG9nX3NpZGViYXIiOiJyaWdodCIsImJsb2dfc2lkZWJhcl9yZXNwb25zaXZlIjoiYm90dG9tIiwicG9ydGZvbGlvX2NvdW50IjoiLTEiLCJwb3J0Zm9saW9fY29sdW1ucyI6IjMiLCJyZWNlbnRfcHJvamVjdHMiOlsiMSJdLCJwb3J0Zm9saW9fY29tbWVudHMiOlsiMSJdLCJwb3J0Zm9saW9fbGlnaHRib3giOlsiMSJdLCJwb3J0Zm9saW9faW1hZ2Vfd2lkdGgiOiI3MjAiLCJwb3J0Zm9saW9faW1hZ2VfaGVpZ2h0IjoiNTUwIiwicG9ydGZvbGlvX2ltYWdlX2Nyb3BwaW5nIjpbIjEiXSwiZ29vZ2xlX21hcF9lbmFibGUiOlsiMSJdLCJjb250YWN0X3BhZ2VfdHlwZSI6ImRlZmF1bHQiLCJjb250YWN0c19lbWFpbCI6InRlc3RAZ21haWwuY29tIiwiZ29vZ2xlX21hcCI6IjUxLjUwNzYyMiwtMC4xMzA1IiwicmVzcG9uc2l2ZSI6WyIxIl0sInJlc3BvbnNpdmVfZnJvbSI6IjEyMDAiLCJuZXdfb3B0aW9ucyI6IiJ9';
        
        /**
       * Get a copy of the saved settings array. 
       */
      $saved_settings = get_option( 'option_tree_settings', array() );
    	  
    	
      /**
       * Custom settings array that will eventually be 
       * passes to the OptionTree Settings API Class.
       */
       
       $sections = array(
            array(
                'id'       => 'general',
                'title'    => __('General', ETHEME_DOMAIN),
                'icon'     => 'icon-cog'
            ),
            array(
                'id'       => 'color_scheme',
                'title'    => __('Color Scheme', ETHEME_DOMAIN),
                'icon'     => 'icon-picture'
            ),
            array(
                'id'       => 'typography',
                'title'    => __('Typography', ETHEME_DOMAIN),
                'icon'     => 'icon-text-height'
            ),
            array(
                'id'       => 'header',
                'title'    => __('Header', ETHEME_DOMAIN),
                'icon'     => 'icon-cogs'
            ),
            array(
                'id'       => 'footer',
                'title'    => __('Footer', ETHEME_DOMAIN),
                'icon'     => 'icon-cogs'
            ),
            array(
                'id'       => 'shop',
                'title'    => __('Shop', ETHEME_DOMAIN),
                'icon'     => 'icon-shopping-cart'
            ),
            array(
                'id'       => 'product_grid',
                'title'    => __('Products Page Layout', ETHEME_DOMAIN),
                'icon'     => 'icon-th'
            ),
            array(
                'id'       => 'single_product',
                'title'    => __('Single Product Page', ETHEME_DOMAIN),
                'icon'     => 'icon-file-alt'
            ),
            array(
                'id'       => 'quick_view',
                'title'    => __('Quick View', ETHEME_DOMAIN),
                'icon'     => 'icon-rocket'
            ),
            array(
                'id'       => 'promo_popup',
                'title'    => __('Promo Popup', ETHEME_DOMAIN),
                'icon'     => 'icon-gift'
            ),
            array(
                'id'       => 'blog_page',
                'title'    => __('Blog Layout', ETHEME_DOMAIN),
                'icon'     => 'icon-indent-right'
            ),
            array(
                'id'       => 'portfolio',
                'title'    => __('Portfolio', ETHEME_DOMAIN),
                'icon'     => 'icon-briefcase'
            ),
            array(
                'id'       => 'contact_form',
                'title'    => __('Contact Form', ETHEME_DOMAIN),
                'icon'     => 'icon-envelope'
            ),
            array(
                'id'       => 'responsive',
                'title'    => __('Responsive', ETHEME_DOMAIN),
                'icon'     => 'icon-mobile-phone'
            ),
            array(
                'id'       => 'custom_css',
                'title'    => __('Custom CSS', ETHEME_DOMAIN),
                'icon'     => 'icon-paper-clip'
            ),
            array(
                'id'       => 'backup',
                'title'    => __('Import/Export', ETHEME_DOMAIN),
                'icon'     => 'icon-cog'
            )
       );
       
       $settings = array(
            array(
                'id'          => 'main_layout',
                'label'       => __('Site Layout', ETHEME_DOMAIN),
                'default'     => 'wide',
                'type'        => 'select',
                'section'     => 'general',
                'choices'     => array(
                  array( 
                    'value' => 'wide',
                    'label' => __('Wide', ETHEME_DOMAIN) 
                  ),
                  array( 
                    'value' => 'boxed',
                    'label' => __('Boxed' , ETHEME_DOMAIN)
                  )
                )
            ),
            array(
                'id'          => 'to_top',
                'label'       => __('"Back To Top" button', ETHEME_DOMAIN),
                'default'     => array(
                    0 => 1
                ),
                'type'        => 'checkbox',
                'section'     => 'general',
                'choices'     => array(
                  array( 
                    'value' => 1,
                    'label' => '' 
                  )
                )
            ),
            array(
                'id'          => 'fixed_nav',
                'label'       => __('Fixed navigation', ETHEME_DOMAIN),
                'default'     => array(0=>1),
                'type'        => 'checkbox',
                'section'     => 'general',
                'choices'     => array(
                  array( 
                    'value' => 1,
                    'label' => '' 
                  )
                )
            ),
            array(
                'id'          => 'nice_scroll',
                'label'       => __('Nice Scroll', ETHEME_DOMAIN),
                'default'     => array(
                    0 => 1
                ),
                'type'        => 'checkbox',
                'section'     => 'general',
                'choices'     => array(
                  array( 
                    'value' => 1,
                    'label' => '' 
                  )
                )
            ),
            /*
            array(
                'id'          => 'fade_animation',
                'label'       => 'Enable fade animation for header and content',
                'default'     => array(
                    0 => 0
                ),
                'type'        => 'checkbox',
                'section'     => 'general',
                'choices'     => array(
                  array( 
                    'value' => 1,
                    'label' => '' 
                  )
                )
            ),*/
            array(
                'id'          => 'favicon_badge',
                'label'       => __('Show products in cart count on the favicon', ETHEME_DOMAIN),
                'default'     => array(
                    0 => 1
                ),
                'type'        => 'checkbox',
                'section'     => 'general',
                'choices'     => array(
                  array( 
                    'value' => 1,
                    'label' => '' 
                  )
                )
            ),
            array(
                'id'          => 'footer_demo',
                'label'       => __('Show footer demo blocks',ETHEME_DOMAIN),
                'desc'        => __('Will be shown if footer sidebars are empty', ETHEME_DOMAIN),
                'default'     => array(0=>1),
                'type'        => 'checkbox',
                'section'     => 'general',
                'choices'     => array(
                  array( 
                    'value' => 1,
                    'label' => '' 
                  )
                )
            ),
            array(
                'id'          => 'mobile_loader',
                'label'       => __('Show loader on mobile', ETHEME_DOMAIN),
                'default'     => array(0=>1),
                'type'        => 'checkbox',
                'section'     => 'general',
                'choices'     => array(
                  array( 
                    'value' => 1,
                    'label' => '' 
                  )
                )
            ),
            array(
                'id'          => 'google_code',
                'label'       => __('Google Analytics Code', ETHEME_DOMAIN),
                'default'     => '',
                'type'        => 'textarea_simple',
                'section'     => 'general'
            ),
            // COLOR SCHEME
            array(
                'id'          => 'main_color_scheme',
                'label'       => __('Main color scheme', ETHEME_DOMAIN),
                'default'     => 'light',
                'type'        => 'select',
                'section'     => 'color_scheme',
                'choices'     => array(
                  array( 
                    'value' => 'light',
                    'label' => __('Light', ETHEME_DOMAIN) 
                  ),
                  array( 
                    'value' => 'dark',
                    'label' => __('Dark', ETHEME_DOMAIN)
                  )
                )
            ), 
            array(
                'id'          => 'activecol',
                'label'       => __('Main Color', ETHEME_DOMAIN),
                'default'     => '#ed1c2e',
                'type'        => 'colorpicker',
                'section'     => 'color_scheme',
            ),
            array(
                'id'          => 'pricecolor',
                'label'       => __('Price Color', ETHEME_DOMAIN),
                'default'     => '#EE3B3B',
                'type'        => 'colorpicker',
                'section'     => 'color_scheme',
            ),
            /*
            array(
                'id'          => 'activehovercol',
                'label'       => 'Active button hover Color',
                'default'     => '#e83636',
                'type'        => 'colorpicker',
                'section'     => 'color_scheme',
            ),
            array(
                'id'          => 'footer_bg',
                'label'       => 'Footer Background Color',
                'default'     => '#222222',
                'type'        => 'colorpicker',
                'section'     => 'color_scheme',
            ),*/
            array(
                'id'          => 'background_img',
                'label'       => __('Site Background', ETHEME_DOMAIN),
                'desc'        => '',
                'default'     => '',
                'type'        => 'background',
                'section'     => 'color_scheme',
            ),
            array(
                'id'          => 'background_cover',
                'label'       => __('Background Image Expanding', ETHEME_DOMAIN),
                'default'     => '',
                'type'        => 'select',
                'section'     => 'color_scheme',
                'choices'     => array(
                  array( 
                    'value' => 'enable',
                    'label' => 'enable' 
                  ),
                  array( 
                    'value' => 'disable',
                    'label' => 'disable' 
                  )
                )
            ),
            // TYPOGRAPHY
            array(
                'id'          => 'mainfont',
                'label'       => __('Main Font', ETHEME_DOMAIN),
                'default'     => '',
                'type'        => 'typography',
                'section'     => 'typography',
            ),
            array(
                'id'          => 'sfont',
                'label'       => __('Body Font', ETHEME_DOMAIN),
                'default'     => '',
                'type'        => 'typography',
                'section'     => 'typography',
            ),
            array(
                'id'          => 'h1',
                'label'       => 'H1',
                'default'     => '',
                'type'        => 'typography',
                'section'     => 'typography',
            ),
            array(
                'id'          => 'h2',
                'label'       => 'H2',
                'default'     => '',
                'type'        => 'typography',
                'section'     => 'typography',
            ),
            array(
                'id'          => 'h3',
                'label'       => 'H3',
                'default'     => '',
                'type'        => 'typography',
                'section'     => 'typography',
            ),
            array(
                'id'          => 'h4',
                'label'       => 'H4',
                'default'     => '',
                'type'        => 'typography',
                'section'     => 'typography',
            ),
            array(
                'id'          => 'h5',
                'label'       => 'H5',
                'default'     => '',
                'type'        => 'typography',
                'section'     => 'typography',
            ),
            array(
                'id'          => 'h6',
                'label'       => 'H6',
                'default'     => '',
                'type'        => 'typography',
                'section'     => 'typography',
            ),
            // HEADER
            array(
                'id'          => 'top_bar',
                'label'       => __('Enable top bar', ETHEME_DOMAIN),
                'default'     => array(0=>1),
                'type'        => 'checkbox',
                'section'     => 'header',
                'choices'     => array(
                  array( 
                    'value' => 1,
                    'label' => '' 
                  )
                )
            ),
            array(
                'id'          => 'top_panel',
                'label'       => __('Enable hidden top panel', ETHEME_DOMAIN),
                'default'     => array(0=>1),
                'type'        => 'checkbox',
                'section'     => 'header',
                'choices'     => array(
                  array( 
                    'value' => 1,
                    'label' => '' 
                  )
                )
            ),
            array(
                'id'          => 'header_type',
                'label'       => __('Header Type', ETHEME_DOMAIN),
                'default'     => 1,
                'type'        => 'radio-image',
                'section'     => 'header',
                'class'       => '',
                'choices'     => array(
                    array(
                        'value'   => 1,
                        'label'   => 'Default',
                        'src'     => OT_URL . '/assets/images/header_v1.jpg'
                    ),
                    array(
                        'value'   => 2,
                        'label'   => 'Variant 2',
                        'src'     => OT_URL . '/assets/images/header_v2.jpg'
                    ),
                    array(
                        'value'   => 3,
                        'label'   => 'Variant 3',
                        'src'     => OT_URL . '/assets/images/header_v3.jpg'
                    ),
                    array(
                        'value'   => 4,
                        'label'   => 'Variant 4',
                        'src'     => OT_URL . '/assets/images/header_v4.jpg'
                    ),
                    array(
                        'value'   => 5,
                        'label'   => 'Variant 5',
                        'src'     => OT_URL . '/assets/images/header_v5.jpg'
                    ),
                    array(
                        'value'   => 6,
                        'label'   => 'Variant 6',
                        'src'     => OT_URL . '/assets/images/header_v6.jpg'
                    ),
                    array(
                        'value'   => 7,
                        'label'   => 'Default',
                        'src'     => OT_URL . '/assets/images/header_v7.jpg'
                    ),
                )
            ),
    		/*
            array(
                'id'          => 'menu_type',
                'label'       => 'Menu Type',
                'default'     => '2',
                'type'        => 'select',
                'section'     => 'header',
                'choices'     => array(
                  array( 
                    'value' => '1',
                    'label' => 'Default Menu' 
                  ),
                  array( 
                    'value' => '2',
                    'label' => 'Mega Menu' 
                  ),
                  array( 
                    'value' => '3',
                    'label' => 'Drop Down Menu' 
                  ),
                  array( 
                    'value' => '4',
                    'label' => 'Combined' 
                  )
                )
            ),*/
            array(
                'id'          => 'languages_area',
                'label'       => __('Enable languages area', ETHEME_DOMAIN),
                'default'     => array(0=>1),
                'type'        => 'checkbox',
                'section'     => 'header',
                'choices'     => array(
                  array( 
                    'value' => 1,
                    'label' => '' 
                  )
                )
            ),
            array(
                'id'          => 'right_panel',
                'label'       => __('Use right side panel', ETHEME_DOMAIN),
                'default'     => array(0=>1),
                'type'        => 'checkbox',
                'section'     => 'header',
                'choices'     => array(
                  array( 
                    'value' => 1,
                    'label' => '' 
                  )
                )
            ),
            array(
                'id'          => 'logo',
                'label'       => __('Logo image', ETHEME_DOMAIN),
                'default'     => '',
                'desc'        => 'Upload image: png, jpg or gif file',
                'type'        => 'upload',
                'section'     => 'header'
            ),
            array(
                'id'          => 'favicon',
                'label'       => __('Favicon', ETHEME_DOMAIN),
                'default'     => '[template_url]/images/favicon.ico',
                'desc'        => __('Upload image: png, jpg or gif file',ETHEME_DOMAIN),
                'type'        => 'upload',
                'section'     => 'header'
            ),
            array(
                'id'          => 'top_links',
                'label'       => __('Enable top links (Register | Sign In)', ETHEME_DOMAIN),
                'default'     => array(
                	0 => 1
                ),
                'type'        => 'checkbox',
                'section'     => 'header',
                'choices'     => array(
                  array( 
                    'value' => 1,
                    'label' => '' 
                  )
                )
            ),
            array(
                'id'          => 'cart_widget',
                'label'       => __('Enable cart widget', ETHEME_DOMAIN),
                'default'     => array(
                	0 => 1
                ),
                'type'        => 'checkbox',
                'section'     => 'header',
                'choices'     => array(
                  array( 
                    'value' => 1,
                    'label' => '' 
                  )
                )
            ),
            array(
                'id'          => 'search_form',
                'label'       => __('Enable search form in header', ETHEME_DOMAIN),
                'default'     => array(
                    0 => 1
                ),
                'type'        => 'checkbox',
                'section'     => 'header',
                'choices'     => array(
                  array( 
                    'value' => 1,
                    'label' => '' 
                  )
                )
            ),
            array(
                'id'          => 'wishlist_link',
                'label'       => __('Show wishlist link', ETHEME_DOMAIN),
                'default'     => array(
                    0 => 1
                ),
                'type'        => 'checkbox',
                'section'     => 'header',
                'choices'     => array(
                  array( 
                    'value' => 1,
                    'label' => '' 
                  )
                )
            ),
            array(
                'id'          => 'breadcrumb_type',
                'label'       => __('Breadcrumb Type', ETHEME_DOMAIN),
                'default'     => 'default',
                'type'        => 'select',
                'section'     => 'header',
                'class'       => '',
                'choices'     => array(
                    array(
                        'value'   => '',
                        'label'   => __('Default', ETHEME_DOMAIN)
                    ),
                    array(
                        'value'   => 'variant2',
                        'label'   => __('Wide block', ETHEME_DOMAIN)
                    ),
                    array(
                        'value'   => 'without-title',
                        'label'   => __('Without title', ETHEME_DOMAIN)
                    )
                )
            ),
            // FOOTER
            array(
                'id'          => 'footer_type',
                'label'       => __('Footer Type', ETHEME_DOMAIN),
                'default'     => 1,
                'type'        => 'radio-image',
                'section'     => 'footer',
                'class'       => '',
                'choices'     => array(
                    array(
                        'value'   => 1,
                        'label'   => 'Default',
                        'src'     => OT_URL . '/assets/images/footer_v1.jpg'
                    ),
                    array(
                        'value'   => 2,
                        'label'   => 'Variant 2',
                        'src'     => OT_URL . '/assets/images/footer_v2.jpg'
                    ),
                    array(
                        'value'   => 3,
                        'label'   => 'Variant 3',
                        'src'     => OT_URL . '/assets/images/footer_v3.jpg'
                    )
                )
            ),
            // CONTACT FORM
            array(
                'id'          => 'google_map_enable',
                'label'       => __('Enable Google Map', ETHEME_DOMAIN),
                'default'     => array(0=>1),
                'type'        => 'checkbox',
                'section'     => 'contact_form',
                'choices'     => array(
                  array( 
                    'value' => 1,
                    'label' => '' 
                  )
                )
            ),
            array(
                'id'          => 'contact_page_type',
                'label'       => __('Choose contact page layout', ETHEME_DOMAIN),
                'default'     => 'default',
                'type'        => 'select',
                'section'     => 'contact_form',
                'choices'     => array(
                  array( 
                    'value' => 'default',
                    'label' => __('Default Layout' , ETHEME_DOMAIN)
                  ),
                  array( 
                    'value' => 'custom',
                    'label' => __('Custom layout' , ETHEME_DOMAIN)
                  )
                )
            ),
            array(
                'id'          => 'contacts_email',
                'label'       => __('Your email for contact form', ETHEME_DOMAIN),
                'default'     => 'test@gmail.com',
                'type'        => 'text',
                'section'     => 'contact_form'
            ),
            array(
                'id'          => 'google_map',
                'label'       => __('Longitude and Latitude for google map', ETHEME_DOMAIN),
                'desc'        => '<b>Example:</b>  51.507622,-0.1305',
                'default'     => '51.507622,-0.1305',
                'type'        => 'text',
                'section'     => 'contact_form'
            ),
            // SHOP
            array(
                'id'          => 'just_catalog',
                'label'       => __('Just Catalog', ETHEME_DOMAIN),
                'desc'        => __('Disable "Add To Cart" button and shopping cart', ETHEME_DOMAIN),
                'default'     => 0,
                'type'        => 'checkbox',
                'section'     => 'shop',
                'choices'     => array(
                  array( 
                    'value' => 1,
                    'label' => '' 
                  )
                )
            ),
            array(
                'id'          => 'checkout_page',
                'label'       => __('Checkout page', ETHEME_DOMAIN),
                'type'        => 'select',
                'section'     => 'shop',
                'default'     => 'stepbystep',
                'choices'     => array(
                  array( 
                    'value' => 'stepbystep',
                    'label' => __('Step By Step' , ETHEME_DOMAIN)
                  ),
                  array( 
                    'value' => 'default',
                    'label' => __('Default', ETHEME_DOMAIN)
                  ),
                  array( 
                    'value' => 'quick',
                    'label' => __('Quick Checkout', ETHEME_DOMAIN)
                  )
                )
            ),
            array(
                'id'          => 'ajax_filter',
                'label'       => __('Enable Ajax Filter', ETHEME_DOMAIN),
                'type'        => 'checkbox',
                'section'     => 'shop',
                'default'     => array(
                    0 => 1
                ),
                'choices'     => array(
                  array( 
                    'value' => 1,
                    'label' => '' 
                  ),
                )
            ),
            array(
                'id'          => 'cats_accordion',
                'label'       => __('Enable Navigation Accordion', ETHEME_DOMAIN),
                'type'        => 'checkbox',
                'section'     => 'shop',
                'default'     => array(
                	0 => 1
                ),
                'choices'     => array(
                  array( 
                    'value' => 1,
                    'label' => '' 
                  ),
                )
            ),/*
            array(
                'id'          => 'default_slider_height',
                'label'       => 'Product Sliders Height',
                'desc'        => '<b>Default: </b> 480',
                'type'        => 'text',
                'section'     => 'shop',
                'default'     => 480
            ),*/
            array(
                'id'          => 'out_of_label',
                'label'       => __('Enable "Out Of Stock" label', ETHEME_DOMAIN),
                'type'        => 'checkbox',
                'section'     => 'shop',
                'default'     => array(
                	0 => 1
                ),
                'choices'     => array(
                  array( 
                    'value' => 1,
                    'label' => '' 
                  ),
                )
            ),
            array(
                'id'          => 'new_icon',
                'label'       => __('Enable "NEW" icon', ETHEME_DOMAIN),
                'type'        => 'checkbox',
                'section'     => 'shop',
                'default'     => array(
                	0 => 1
                ),
                'choices'     => array(
                  array( 
                    'value' => 1,
                    'label' => '' 
                  ),
                )
            ),
            array(
                'id'          => 'new_icon_width',
                'label'       => __('"NEW" Icon width', ETHEME_DOMAIN),
                'desc'        => __('<b>Example: </b> 60', ETHEME_DOMAIN),
                'type'        => 'text',
                'section'     => 'shop',
                'default'     => 48
            ),
            array(
                'id'          => 'new_icon_height',
                'label'       => __('"NEW" Icon height', ETHEME_DOMAIN),
                'desc'        => __('<b>Example: </b> 20', ETHEME_DOMAIN),
                'type'        => 'text',
                'section'     => 'shop',
                'default'     => 48
            ),
            array(
                'id'          => 'new_icon_url',
                'label'       => __('"NEW" Icon Image', ETHEME_DOMAIN),
                'default'     => '',
                'desc'        => __('Upload image: png, jpg or gif file', ETHEME_DOMAIN),
                'type'        => 'upload',
                'section'     => 'shop'
            ),
            array(
                'id'          => 'sale_icon',
                'label'       => __('Enable "Sale" icon', ETHEME_DOMAIN),
                'type'        => 'checkbox',
                'section'     => 'shop',
                'default'     => array(
                	0 => 1
                ),
                'choices'     => array(
                  array( 
                    'value' => 1,
                    'label' => '' 
                  ),
                )
            ),
            array(
                'id'          => 'sale_icon_width',
                'label'       => __('"SALE" Icon width', ETHEME_DOMAIN),
                'default'     => '',
                'desc'        => __('<b>Example: </b> 60', ETHEME_DOMAIN),
                'type'        => 'text',
                'section'     => 'shop',
                'default'     => 48
            ),
            array(
                'id'          => 'sale_icon_height',
                'label'       => __('"SALE" Icon height', ETHEME_DOMAIN),
                'default'     => '',
                'desc'        => __('<b>Example: </b> 20', ETHEME_DOMAIN),
                'type'        => 'text',
                'section'     => 'shop',
                'default'     => 48
            ),
            array(
                'id'          => 'sale_icon_url',
                'default'     => '',
                'label'       => __('"SALE" Icon Image', ETHEME_DOMAIN),
                'desc'        => __('Upload image: png, jpg or gif file', ETHEME_DOMAIN),
                'type'        => 'upload',
                'section'     => 'shop'
            ),
            array(
                'id'          => 'product_bage_banner',
                'label'       => __('Product Page Banner', ETHEME_DOMAIN),
                'default'     => '
    <p>
    <img src="[template_url]/images/assets/shop-banner.jpg" />
    </p>
                ',
                'desc'        => __('Upload image: png, jpg or gif file', ETHEME_DOMAIN),
                'type'        => 'textarea',
                'section'     => 'shop'
            ),
            array(
                'id'          => 'empty_cart_content',
                'label'       => __('Text for empty cart', ETHEME_DOMAIN),
                'default'     => __('
    <div>Ваша корзина пуста</div>
    <p>Вы не добавили ни одного товара в корзину.</p>
                ', ETHEME_DOMAIN),
                'type'        => 'textarea',
                'section'     => 'shop'
            ),
            array(
                'id'          => 'empty_category_content',
                'label'       => __('Text for empty category', ETHEME_DOMAIN),
                'default'     => __('
    <div>Товары не найдены</div>
                ', ETHEME_DOMAIN),
                'type'        => 'textarea',
                'section'     => 'shop'
            ),
            array(
                'id'          => 'account_sidebar',
                'label'       => __('Enable sidebar on "My Account" page', ETHEME_DOMAIN),
                'default'     => array(0=>1),
                'type'        => 'checkbox',
                'section'     => 'shop',
                'choices'     => array(
                  array( 
                    'value' => 1,
                    'label' => '' 
                  )
                )
            ),
            // Product Grid
            
            array(
                'id'          => 'view_mode',
                'label'       => __('Products view mode', ETHEME_DOMAIN),
                'type'        => 'select',
                'section'     => 'product_grid',
                'default'     => 'grid_list',
                'class'       => 'prodcuts_per_row',
                'choices'     => array(
                  array( 
                    'value' => 'grid_list',
                    'label' => __('Grid/List', ETHEME_DOMAIN) 
                  ),
                  array( 
                    'value' => 'list_grid',
                    'label' => __('List/Grid', ETHEME_DOMAIN) 
                  ),
                  array( 
                    'value' => 'grid',
                    'label' => __('Only Grid', ETHEME_DOMAIN) 
                  ),
                  array( 
                    'value' => 'list',
                    'label' => __('Only List', ETHEME_DOMAIN) 
                  )
                )
            ),
            array(
                'id'          => 'prodcuts_per_row',
                'label'       => __('Products per row', ETHEME_DOMAIN),
                'type'        => 'select',
                'section'     => 'product_grid',
                'default'     => 3,
                'class'       => 'prodcuts_per_row',
                'choices'     => array(
                  array( 
                    'value' => 3,
                    'label' => '3' 
                  ),
                  array( 
                    'value' => 4,
                    'label' => '4' 
                  ),
                  array( 
                    'value' => 5,
                    'label' => '5' 
                  ),
                  array( 
                    'value' => 6,
                    'label' => '6' 
                  ),
                )
            ),
            array(
                'id'          => 'products_per_page',
                'label'       => __('Products per page', ETHEME_DOMAIN),
                'type'        => 'text',
                'default'     => 12,
                'section'     => 'product_grid'
            ),
            array(
                'id'          => 'grid_sidebar',
                'label'       => __('Layout', ETHEME_DOMAIN),
                'desc'        => __('Sidebar position', ETHEME_DOMAIN),
                'default'     => 'left',
                'type'        => 'radio-image',
                'section'     => 'product_grid',
                'class'       => '',
                'choices'     => array(
                    array(
                        'value'   => 'left',
                        'label'   => __('Left Sidebar', ETHEME_DOMAIN),
                        'src'     => OT_URL . '/assets/images/layout/left-sidebar.png'
                    ),
                    array(
                        'value'   => 'right',
                        'label'   => __('Right Sidebar', ETHEME_DOMAIN),
                        'src'     => OT_URL . '/assets/images/layout/right-sidebar.png'
                    ),
                    array(
                        'value'   => 'without',
                        'label'   => __('Without Sidebar', ETHEME_DOMAIN),
                        'src'     => OT_URL . '/assets/images/layout/full-width.png'
                    )
                )
            ),
            array(
                'id'          => 'product_img_hover',
                'label'       => __('Product Image Hover', ETHEME_DOMAIN),
                'type'        => 'select',
                'section'     => 'product_grid',
                'default'     => 'slider',
                'choices'     => array(
                  array( 
                    'value' => 'disable',
                    'label' => __('Disable', ETHEME_DOMAIN)
                  ),
                  array( 
                    'value' => 'description',
                    'label' => __('Description', ETHEME_DOMAIN) 
                  ),
                  array( 
                    'value' => 'swap',
                    'label' => __('Swap', ETHEME_DOMAIN)
                  ),
                  array( 
                    'value' => 'tooltip',
                    'label' => __('Tooltip', ETHEME_DOMAIN) 
                  ),
                  array( 
                    'value' => 'slider',
                    'label' => __('Images Slider' , ETHEME_DOMAIN)
                  ),
                )
            ),
            array(
                'id'          => 'descr_length',
                'label'       => __('Number of words for description (hover effect)', ETHEME_DOMAIN),
                'default'     => 30,
                'type'        => 'text',
                'section'     => 'product_grid'
            ),
            array(
                'id'          => 'product_page_image_width',
                'label'       => __('Product Images Width', ETHEME_DOMAIN),
                'default'     => 500,
                'type'        => 'text',
                'section'     => 'product_grid'
            ),
            array(
                'id'          => 'product_page_image_height',
                'label'       => __('Product Images Height', ETHEME_DOMAIN),
                'default'     => 700,
                'type'        => 'text',
                'section'     => 'product_grid'
            ),
            array(
                'id'          => 'product_page_image_cropping',
                'label'       => __('Image Cropping', ETHEME_DOMAIN),
                'type'        => 'checkbox',
                'default'     => array(
                    0 => 0
                ),
                'section'     => 'product_grid',
                'choices'     => array(
                  array( 
                    'value' => 1,
                    'label' => '' 
                  ),
                )
            ),
            array(
                'id'          => 'product_page_productname',
                'label'       => __('Show product name', ETHEME_DOMAIN),
                'type'        => 'checkbox',
                'section'     => 'product_grid',
                'default'     => array(
                    0 => 1
                ),
                'choices'     => array(
                  array( 
                    'value' => 1,
                    'label' => '' 
                  ),
                )
            ),
            array(
                'id'          => 'product_page_cats',
                'label'       => __('Show product categories', ETHEME_DOMAIN),
                'type'        => 'checkbox',
                'section'     => 'product_grid',
                'default'     => array(
                    0 => 1
                ),
                'choices'     => array(
                  array( 
                    'value' => 1,
                    'label' => '' 
                  ),
                )
            ),
            array(
                'id'          => 'product_page_price',
                'label'       => __('Show Price', ETHEME_DOMAIN),
                'type'        => 'checkbox',
                'section'     => 'product_grid',
                'default'     => array(
                	0 => 1
                ),
                'choices'     => array(
                  array(
                    'value' => 1,
                    'label' => '' 
                  ),
                )
            ),
            array(
                'id'          => 'product_page_addtocart',
                'label'       => __('Show "Add to cart" button', ETHEME_DOMAIN),
                'type'        => 'checkbox',
                'section'     => 'product_grid',
                'default'     => array(
                	0 => 1
                ),
                'choices'     => array(
                  array( 
                    'value' => 1,
                    'label' => '' 
                  ),
                )
            ),
            // BLOG 
            array(
                'id'          => 'blog_layout',
                'label'       => __('Blog Layout', ETHEME_DOMAIN),
                'type'        => 'select',
                'section'     => 'blog_page',
                'default'     => 'default',
                'choices'     => array(
                  array( 
                    'value' => 'default',
                    'label' => __('Default', ETHEME_DOMAIN) 
                  ),
                  array( 
                    'value' => 'default_portrait',
                    'label' => __('Default Portrait', ETHEME_DOMAIN) 
                  ),
                  array( 
                    'value' => 'grid',
                    'label' => __('Grid', ETHEME_DOMAIN)
                  ),
                  array( 
                    'value' => 'timeline',
                    'label' => __('Timeline' , ETHEME_DOMAIN)
                  ),
                )
            ),
            /*
            array(
                'id'          => 'default_blog_slider_height',
                'label'       => 'Posts Sliders Height',
                'desc'        => '<b>Default: </b> 300',
                'type'        => 'text',
                'section'     => 'blog_page',
                'default'     => 300
            ),*/
            array(
                'id'          => 'ajax_posts_loading',
                'label'       => __('AJAX Infinite Posts Loading', ETHEME_DOMAIN),
                'type'        => 'checkbox',
                'section'     => 'blog_page',
                'default'     => array(0=>1),
                'choices'     => array(
                  array( 
                    'value' => 1,
                    'label' => '' 
                  ),
                )
            ),
            array(
                'id'          => 'blog_lightbox',
                'label'       => __('Enable Lightbox For Blog Posts', ETHEME_DOMAIN),
                'type'        => 'checkbox',
                'section'     => 'blog_page',
                'default'     => array(0=>1),
                'choices'     => array(
                  array( 
                    'value' => 1,
                    'label' => '' 
                  ),
                )
            ),
            array(
                'id'          => 'blog_slider',
                'label'       => __('Enable Sliders for posts images', ETHEME_DOMAIN),
                'type'        => 'checkbox',
                'section'     => 'blog_page',
                'default'     => 1,
                'choices'     => array(
                  array( 
                    'value' => 1,
                    'label' => '' 
                  ),
                )
            ),
            array(
                'id'          => 'blog_page_image_width',
                'label'       => __('Post Thumbnail Width', ETHEME_DOMAIN),
                'default'     => 1000,
                'type'        => 'text',
                'section'     => 'blog_page'
            ),
            array(
                'id'          => 'blog_page_image_height',
                'label'       => __('Post Thumbnail Height', ETHEME_DOMAIN),
                'default'     => 500,
                'type'        => 'text',
                'section'     => 'blog_page'
            ),
            array(
                'id'          => 'blog_page_image_cropping',
                'label'       => __('Image Cropping', ETHEME_DOMAIN),
                'type'        => 'checkbox',
                'default'     => array(
                    0 => 1
                ),
                'section'     => 'blog_page',
                'choices'     => array(
                  array( 
                    'value' => 1,
                    'label' => '' 
                  ),
                )
            ),
            array(
                'id'          => 'posts_links',
                'label'       => __('Show Previous and Next posts links', ETHEME_DOMAIN),
                'type'        => 'checkbox',
                'section'     => 'blog_page',
                'default'     => array(0=>1),
                'choices'     => array(
                  array( 
                    'value' => 1,
                    'label' => '' 
                  ),
                )
            ),
            array(
                'id'          => 'post_share',
                'label'       => __('Show Share buttons', ETHEME_DOMAIN),
                'type'        => 'checkbox',
                'section'     => 'blog_page',
                'default'     => array(0=>1),
                'choices'     => array(
                  array( 
                    'value' => 1,
                    'label' => '' 
                  ),
                )
            ),/*
            array(
                'id'          => 'blog_layout',
                'label'       => 'Blog page layout',
                'default'     => 'default',
                'type'        => 'radio-image',
                'section'     => 'blog_page',
                'class'       => '',
                'choices'     => array(
                    array(
                        'value'   => 'default',
                        'label'   => 'Default',
                        'src'     => get_template_directory_uri().'/code/css/images/blog_1.jpg'
                    ),
                    array(
                        'value'   => 'portrait',
                        'label'   => 'Portrait Images',
                        'src'     => get_template_directory_uri().'/code/css/images/blog_2.jpg'
                    ),
                    array(
                        'value'   => 'horizontal',
                        'label'   => 'Portrait Images 2',
                        'src'     => get_template_directory_uri().'/code/css/images/blog_3.jpg'
                    )
                )
            ),*/
            array(
                'id'          => 'blog_sidebar',
                'label'       => __('Sidebar position', ETHEME_DOMAIN),
                'default'     => 'left',
                'type'        => 'radio-image',
                'section'     => 'blog_page',
                'class'       => '',
                'choices'     => array(
                    array(
                        'value'   => 'no_sidebar',
                        'label'   => __('Without Sidebar', ETHEME_DOMAIN),
                        'src'     => OT_URL . '/assets/images/layout/full-width.png'
                    ),
                    array(
                        'value'   => 'left',
                        'label'   => __('Left Sidebar', ETHEME_DOMAIN),
                        'src'     => OT_URL . '/assets/images/layout/left-sidebar.png'
                    ),
                    array(
                        'value'   => 'right',
                        'label'   => __('Right Sidebar', ETHEME_DOMAIN),
                        'src'     => OT_URL . '/assets/images/layout/right-sidebar.png'
                    )
                )
            ),
            array(
                'id'          => 'blog_sidebar_width',
                'label'       => __('Sidebar width', ETHEME_DOMAIN),
                'default'     => 4,
                'type'        => 'select',
                'section'     => 'blog_page',
                'class'       => '',
                'choices'     => array(
                    array(
                        'value'   => 4,
                        'label'   => '1/3'
                    ),
                    array(
                        'value'   => 3,
                        'label'   => '1/4'
                    ),
                    array(
                        'value'   => 2,
                        'label'   => '1/6'
                    ),
                )
            ),
            array(
                'id'          => 'blog_sidebar_responsive',
                'label'       => __('Sidebar position for responsive layout', ETHEME_DOMAIN),
                'default'     => 'bottom',
                'type'        => 'select',
                'section'     => 'blog_page',
                'class'       => '',
                'choices'     => array(
                    array(
                        'value'   => 'top',
                        'label'   => __('Top', ETHEME_DOMAIN)
                    ),
                    array(
                        'value'   => 'bottom',
                        'label'   => __('Bottom', ETHEME_DOMAIN)
                    )
                )
            ),
            // Single Product Page
            array(
                'id'          => 'single_sidebar',
                'label'       => __('Sidebar position', ETHEME_DOMAIN),
                'default'     => 'right',
                'type'        => 'radio-image',
                'section'     => 'single_product',
                'class'       => '',
                'choices'     => array(
                    array(
                        'value'   => 'no_sidebar',
                        'label'   => __('Without Sidebar', ETHEME_DOMAIN),
                        'src'     => OT_URL . '/assets/images/layout/full-width.png'
                    ),
                    array(
                        'value'   => 'left',
                        'label'   => __('Left Sidebar', ETHEME_DOMAIN),
                        'src'     => OT_URL . '/assets/images/layout/left-sidebar.png'
                    ),
                    array(
                        'value'   => 'right',
                        'label'   => __('Right Sidebar', ETHEME_DOMAIN),
                        'src'     => OT_URL . '/assets/images/layout/right-sidebar.png'
                    )
                )
            ),
            array(
                'id'          => 'upsell_location',
                'label'       => __('Location of upsell products', ETHEME_DOMAIN),
                'default'     => 'sidebar',
                'type'        => 'select',
                'section'     => 'single_product',
                'class'       => '',
                'choices'     => array(
                    array(
                        'value'   => 'sidebar',
                        'label'   => __('Sidebar', ETHEME_DOMAIN)
                    ),
                    array(
                        'value'   => 'after_content',
                        'label'   => __('After content', ETHEME_DOMAIN)
                    )
                )
            ),
            array(
                'id'          => 'show_related',
                'label'       => __('Show related products', ETHEME_DOMAIN),
                'default'     => array(
                    0 => 1
                ),
                'type'        => 'checkbox',
                'section'     => 'single_product',
                'class'       => '',
                'choices'     => array(
                    array(
                        'value'   => 1,
                        'label'   => ''
                    )
                )
            ),
            array(
                'id'          => 'ajax_addtocart',
                'label'       => __('Ajax "Add To Cart" (for simple products only)', ETHEME_DOMAIN),
                'default'     => array(
                    0 => 1
                ),
                'type'        => 'checkbox',
                'section'     => 'single_product',
                'class'       => '',
                'choices'     => array(
                    array(
                        'value'   => 1,
                        'label'   => ''
                    )
                )
            ),
            array(
                'id'          => 'show_name_on_single',
                'label'       => __('Show Product name', ETHEME_DOMAIN),
                'default'     => 0,
                'type'        => 'checkbox',
                'section'     => 'single_product',
                'class'       => '',
                'choices'     => array(
                    array(
                        'value'   => 1,
                        'label'   => ''
                    )
                )
            ),
            /*
            array(
                'id'          => 'product_qr_code',
                'label'       => 'Show QR Code with the product URL',
                'default'     => array(
                    0 => 1
                ),
                'type'        => 'checkbox',
                'section'     => 'single_product',
                'class'       => '',
                'choices'     => array(
                    array(
                        'value'   => 1,
                        'label'   => ''
                    )
                )
            ),*/
            array(
                'id'          => 'zoom_effect',
                'label'       => __('Zoom effect', ETHEME_DOMAIN),
                'default'     => 'window',
                'type'        => 'select',
                'section'     => 'single_product',
                'class'       => '',
                'choices'     => array(
                    array(
                        'value'   => 'disable',
                        'label'   => __('Disable', ETHEME_DOMAIN)
                    ),
                    array(
                        'value'   => 'slippy',
                        'label'   => __('Slippy', ETHEME_DOMAIN)
                    ),
                    array(
                        'value'   => 'window',
                        'label'   => __('Window', ETHEME_DOMAIN)
                    )
                )
            ),
            array(
                'id'          => 'single_product_thumb_width',
                'label'       => __('Product Thumbnails Width', ETHEME_DOMAIN),
                'default'     => 120,
                'type'        => 'text',
                'section'     => 'single_product'
            ),
            array(
                'id'          => 'single_product_thumb_height',
                'label'       => __('Product Thumbnails Height', ETHEME_DOMAIN),
                'default'     => 130,
                'type'        => 'text',
                'section'     => 'single_product'
            ),
            array(
                'id'          => 'gallery_lightbox',
                'label'       => __('Enable Lightbox for Product Images', ETHEME_DOMAIN),
                'default'     => array(
                    0 => 1
                ),
                'type'        => 'checkbox',
                'section'     => 'single_product',
                'class'       => '',
                'choices'     => array(
                    array(
                        'value'   => 1,
                        'label'   => ''
                    )
                )
            ),/*
            array(
                'id'          => 'size_guide_img',
                'label'       => 'Size Guide img',
                'default'     => 'wp-content/themes/theleader/images/assets/sizeguide.jpg',
                'desc'        => 'Upload image: png, jpg or gif file',
                'type'        => 'upload',
                'section'     => 'single_product'
            ),
            array(
                'id'          => 'size_guide_img_mobile',
                'label'       => 'Size Guide img (mobile)',
                'default'     => 'wp-content/themes/idstore/images/assets/size-guide-mobile.jpg',
                'desc'        => 'Upload image: png, jpg or gif file',
                'type'        => 'upload',
                'section'     => 'single_product'
            ),*/
            array(
                'id'          => 'tabs_type',
                'label'       => __('Tabs type', ETHEME_DOMAIN),
                'default'     => 'tabs_default',
                'type'        => 'select',
                'section'     => 'single_product',
                'class'       => '',
                'choices'     => array(
                    array(
                        'value'   => 'tabs-default',
                        'label'   => __('Default', ETHEME_DOMAIN)
                    ),
                    array(
                        'value'   => 'left-bar',
                        'label'   => __('Left Bar', ETHEME_DOMAIN)
                    ),
                    array(
                        'value'   => 'right-bar',
                        'label'   => __('Right Bar', ETHEME_DOMAIN)
                    ),
                    array(
                        'value'   => 'accordion',
                        'label'   => __('Accordion', ETHEME_DOMAIN)
                    )
                )
            ),
            array(
                'id'          => 'share_icons',
                'label'       => __('Show share buttons', ETHEME_DOMAIN),
                'default'     => array(
                    0 => 1
                ),
                'type'        => 'checkbox',
                'section'     => 'single_product',
                'class'       => '',
                'choices'     => array(
                    array(
                        'value'   => 1,
                        'label'   => ''
                    )
                )
            ),
            array(
                'id'          => 'custom_tab_title',
                'label'       => __('Custom Tab Title', ETHEME_DOMAIN),
                'default'     => 'Returns & Delivery',
                'type'        => 'text',
                'section'     => 'single_product'
            ),
            array(
                'id'          => 'custom_tab',
                'label'       => __('Return', ETHEME_DOMAIN),
                'desc'        => __('Enter custom content you would like to output to the product custom tab (for all products)', ETHEME_DOMAIN),
                'default'     => '
    [row][column size="one-half"]<h5>Returns and Exchanges</h5><p>There are a few important things to keep in mind when returning a product you purchased.You can return unwanted items by post within 7 working days of receipt of your goods.</p>[checklist style="arrow"]
    <ul>
    <li>You have 14 calendar days to return an item from the date you received it. </li>
    <li>Only items that have been purchased directly from Us.</li>
    <li>Please ensure that the item you are returning is repackaged with all elements.</li>
    </ul>
    [/checklist] [/column][column size="one-half"]
    <h5>Ship your item back to Us</h5>Firstly Print and return this Returns Form to:<br /> <p>30 South Park Avenue, San Francisco, CA 94108, USA<br /> Please remember to ensure that the item you are returning is repackaged with all elements.</p><br /> <span class="underline">For more information, view our full Returns and Exchanges information.</span>[/column][/row]
                ',
                'type'        => 'textarea',
                'section'     => 'single_product'
            ),
            array(
                'id'          => 'demo_data',
                'label'       => __('Install demo content just in few clicks', ETHEME_DOMAIN),
                'default'     => '',
                'desc'        => '',
                'type'        => 'demo_data',
                'section'     => 'backup',
                'choices'     => array(
                    array(
                        'value'   => 'e-commerce',
                        'label'   => __('E-commerce', ETHEME_DOMAIN)
                    ),
                    array(
                        'value'   => 'corporate',
                        'label'   => __('Corporate', ETHEME_DOMAIN)
                    )
                )
            ),
            array(
                'id'          => 'import_export',
                'label'       => __('Import or Export your theme configuration', ETHEME_DOMAIN),
                'default'     => '',
                'desc'        => '',
                'type'        => 'backup',
                'section'     => 'backup'
            ),
            // QUICK VIEW
            array(
                'id'          => 'quick_view',
                'label'       => __('ENABLE QUICK VIEW', ETHEME_DOMAIN),
                'type'        => 'checkbox',
                'section'     => 'quick_view',
                'default'     => array(0=>1),
                'choices'     => array(
                  array( 
                    'value' => 1,
                    'label' => ''
                  ),
                )
            ),
            array(
                'id'          => 'quick_images',
                'label'       => __('Product images', ETHEME_DOMAIN),
                'default'     => 'slider',
                'type'        => 'select',
                'section'     => 'quick_view',
                'class'       => '',
                'choices'     => array(
                    array(
                        'value'   => 'none',
                        'label'   => __('None', ETHEME_DOMAIN)
                    ),
                    array(
                        'value'   => 'slider',
                        'label'   => __('Slider', ETHEME_DOMAIN)
                    ),
                    array(
                        'value'   => 'single',
                        'label'   => __('Single', ETHEME_DOMAIN)
                    )
                )
            ),
            array(
                'id'          => 'quick_product_name',
                'label'       => __('Product name', ETHEME_DOMAIN),
                'type'        => 'checkbox',
                'section'     => 'quick_view',
                'default'     => array(0=>1),
                'choices'     => array(
                  array( 
                    'value' => 1,
                    'label' => '' 
                  ),
                )
            ),
            array(
                'id'          => 'quick_price',
                'label'       => __('Price', ETHEME_DOMAIN),
                'type'        => 'checkbox',
                'section'     => 'quick_view',
                'default'     => array(0=>1),
                'choices'     => array(
                  array( 
                    'value' => 1,
                    'label' => '' 
                  ),
                )
            ),
            array(
                'id'          => 'quick_rating',
                'label'       => __('Product star reting', ETHEME_DOMAIN),
                'type'        => 'checkbox',
                'section'     => 'quick_view',
                'default'     => array(0=>1),
                'choices'     => array(
                  array( 
                    'value' => 1,
                    'label' => '' 
                  ),
                )
            ),
            array(
                'id'          => 'quick_sku',
                'label'       => __('Product code', ETHEME_DOMAIN),
                'type'        => 'checkbox',
                'section'     => 'quick_view',
                'default'     => array(0=>1),
                'choices'     => array(
                  array( 
                    'value' => 1,
                    'label' => '' 
                  ),
                )
            ),
            array(
                'id'          => 'quick_descr',
                'label'       => __('Short description', ETHEME_DOMAIN),
                'type'        => 'checkbox',
                'section'     => 'quick_view',
                'default'     => array(0=>1),
                'choices'     => array(
                  array( 
                    'value' => 1,
                    'label' => '' 
                  ),
                )
            ),
            array(
                'id'          => 'quick_add_to_cart',
                'label'       => __('Add to cart', ETHEME_DOMAIN),
                'type'        => 'checkbox',
                'section'     => 'quick_view',
                'default'     => array(0=>1),
                'choices'     => array(
                  array( 
                    'value' => 1,
                    'label' => '' 
                  ),
                )
            ),
            array(
                'id'          => 'quick_share',
                'label'       => __('Share icons', ETHEME_DOMAIN),
                'type'        => 'checkbox',
                'section'     => 'quick_view',
                'default'     => array(0=>1),
                'choices'     => array(
                  array( 
                    'value' => 1,
                    'label' => '' 
                  ),
                )
            ),
            // Promo popup
            array(
                'id'          => 'promo_popup',
                'label'       => __('Enable promo popup', ETHEME_DOMAIN),
                'type'        => 'checkbox',
                'section'     => 'promo_popup',
                'default'     => array(0=>1),
                'choices'     => array(
                  array( 
                    'value' => 1,
                    'label' => '' 
                  ),
                )
            ),
            array(
                'id'          => 'pp_content',
                'label'       => __('Popup content', ETHEME_DOMAIN),
                'type'        => 'textarea',
                'section'     => 'promo_popup',
                'default'     => 'You can add any HTML here (admin -> Theme Options -> Promo Popup).<br> We suggest you create a static block and put it here using shortcode'
            ),
            array(
                'id'          => 'pp_width',
                'label'       => __('Popup width', ETHEME_DOMAIN),
                'default'     => 750,
                'type'        => 'text',
                'section'     => 'promo_popup'
            ),
            array(
                'id'          => 'pp_height',
                'label'       => __('Popup height', ETHEME_DOMAIN),
                'default'     => 350,
                'type'        => 'text',
                'section'     => 'promo_popup'
            ),
            array(
                'id'          => 'pp_bg',
                'label'       => __('Popup background', ETHEME_DOMAIN),
                'default'     => '',
                'type'        => 'background',
                'section'     => 'promo_popup'
            ),
            // Portfolio
            array(
                'id'          => 'portfolio_count',
                'label'       => __('Items per page', ETHEME_DOMAIN),
                'default'     => -1,
                'desc'        => 'Use -1 to show all items',
                'type'        => 'text',
                'section'     => 'portfolio'
            ),
            array(
                'id'          => 'portfolio_columns',
                'label'       => __('Columns', ETHEME_DOMAIN),
                'type'        => 'select',
                'section'     => 'portfolio',
                'default'     => 3,
                'choices'     => array(
                  array( 
                    'value' => 2,
                    'label' => 2
                  ),
                  array( 
                    'value' => 3,
                    'label' => 3 
                  ),
                  array( 
                    'value' => 4,
                    'label' => 4 
                  ),
                )
            ),
            array(
                'id'          => 'project_name',
                'label'       => __('Show Project names', ETHEME_DOMAIN),
                'type'        => 'checkbox',
                'section'     => 'portfolio',
                'default'     => array(0=>1),
                'choices'     => array(
                  array( 
                    'value' => 1,
                    'label' => '' 
                  ),
                )
            ),
            array(
                'id'          => 'project_byline',
                'label'       => __('Show ByLine', ETHEME_DOMAIN),
                'type'        => 'checkbox',
                'section'     => 'portfolio',
                'default'     => array(0=>1),
                'choices'     => array(
                  array( 
                    'value' => 1,
                    'label' => '' 
                  ),
                )
            ),
            array(
                'id'          => 'project_excerpt',
                'label'       => __('Show Excerpt', ETHEME_DOMAIN),
                'type'        => 'checkbox',
                'section'     => 'portfolio',
                'default'     => array(0=>1),
                'choices'     => array(
                  array( 
                    'value' => 1,
                    'label' => '' 
                  ),
                )
            ),
            array(
                'id'          => 'recent_projects',
                'label'       => __('Show recent projects', ETHEME_DOMAIN),
                'type'        => 'checkbox',
                'section'     => 'portfolio',
                'default'     => array(0=>1),
                'choices'     => array(
                  array( 
                    'value' => 1,
                    'label' => '' 
                  ),
                )
            ),
            array(
                'id'          => 'portfolio_comments',
                'label'       => __('Enable Comments For Projects', ETHEME_DOMAIN),
                'type'        => 'checkbox',
                'section'     => 'portfolio',
                'default'     => array(0=>1),
                'choices'     => array(
                  array( 
                    'value' => 1,
                    'label' => '' 
                  ),
                )
            ),
            array(
                'id'          => 'portfolio_lightbox',
                'label'       => __('Enable Lightbox For Projects', ETHEME_DOMAIN),
                'type'        => 'checkbox',
                'section'     => 'portfolio',
                'default'     => array(0=>1),
                'choices'     => array(
                  array( 
                    'value' => 1,
                    'label' => '' 
                  ),
                )
            ),
            array(
                'id'          => 'portfolio_image_width',
                'label'       => __('Project Images Width', ETHEME_DOMAIN),
                'default'     => 720,
                'type'        => 'text',
                'section'     => 'portfolio'
            ),
            array(
                'id'          => 'portfolio_image_height',
                'label'       => __('Project Images Height', ETHEME_DOMAIN),
                'default'     => 550,
                'type'        => 'text',
                'section'     => 'portfolio'
            ),
            array(
                'id'          => 'portfolio_image_cropping',
                'label'       => __('Image Cropping', ETHEME_DOMAIN),
                'type'        => 'checkbox',
                'default'     => array(
                    0 => 1
                ),
                'section'     => 'portfolio',
                'choices'     => array(
                  array( 
                    'value' => 1,
                    'label' => '' 
                  ),
                )
            ),
            // Responsive
            array(
                'id'          => 'responsive',
                'label'       => __('Enable Responsive Design', ETHEME_DOMAIN),
                'default'     => array(
                	0 => 1
                ),
                'type'        => 'checkbox',
                'section'     => 'responsive',
                'choices'     => array(
                  array( 
                    'value' => 1,
                    'label' => '' 
                  )
                )
            ),
            array(
                'id'          => 'responsive_from',
                'label'       => __('Large resolution from', ETHEME_DOMAIN),
                'desc'        => 'By default: 1200',
                'default'     => 1200,
                'type'        => 'text',
                'section'     => 'responsive',
            ),
            /*
            array(
                'id'          => 'loader',
                'label'       => 'Show loader icon until site loading on mobile devices',
                'default'     => array(
                	0 => 1
                ),
                'type'        => 'checkbox',
                'section'     => 'responsive',
                'choices'     => array(
                  array( 
                    'value' => 1,
                    'label' => '' 
                  )
                )
            ),
            array(
                'id'          => 'banner_mask',
                'label'       => 'Show banner mask on mobile device',
                'default'     => 'enable',
                'type'        => 'select',
                'section'     => 'responsive',
                'choices'     => array(
                  array( 
                    'value' => 'enable',
                    'label' => 'Enable' 
                  ),
                  array( 
                    'value' => 'disable',
                    'label' => 'Disable' 
                  ),
                )
            ),*/
            // Custom CSS
            array(
                'id'          => 'custom_css',
                'label'       => __('Enable Custom CSS file', ETHEME_DOMAIN),
                'desc'        => __('Enable this option to load "custom.css" file in which you can override the default styling of the theme. To create "custom.css" you can use the file "default.custom.css" which is located in theme directory.', ETHEME_DOMAIN),
                'default'     => 0,
                'type'        => 'checkbox',
                'section'     => 'custom_css',
                'choices'     => array(
                  array( 
                    'value' => 1,
                    'label' => '' 
                  )
                )
            ),
            
            
            
       );
       
       if($return) {
    	   return $settings;
       }
    
      $custom_settings = array(
        'contextual_help' => array(
          'content'       => array( 
            array(
              'id'        => 'general_help',
              'title'     => __('General', ETHEME_DOMAIN),
              'content'   => ''
            )
          ),
          'sidebar'       => '',
        ),
        'sections'        => $sections,
        'settings'        => $settings
      );
      
      if(is_array($settings)){
    	  foreach($settings as $key => $value){	
    		  $defaults[$value['id']] = $value['default'];
    	  }
      }
      
      add_option( 'option_tree', $defaults ); // update_option  add_option
    	
      
      /* settings are not the same update the DB */
      if ( $saved_settings !== $custom_settings ) {
        update_option( 'option_tree_settings', $custom_settings ); 
      }
      
    } 
    
    /**
     * Initialize the meta boxes for pages. 
     */
    add_action( 'admin_init', 'page_meta_boxes' );
    
    
    function page_meta_boxes() {
    global $wpdb;
        $page_options = array(
            array(
                'id'          => 'sidebar_state',
                'label'       => __('Sidebar Position', ETHEME_DOMAIN),
                'type'        => 'select',
                'choices'     => array(
                      array( 
                        'value' => '',
                        'label' => __('Default' , ETHEME_DOMAIN)
                      ),
                      array( 
                        'value' => 'no_sidebar',
                        'label' => __('Without Sidebar', ETHEME_DOMAIN) 
                      ),
                      array( 
                        'value' => 'left',
                        'label' => __('Left Sidebar', ETHEME_DOMAIN) 
                      ),
                      array( 
                        'value' => 'right',
                        'label' => __('Right Sidebar' , ETHEME_DOMAIN)
                      )
                    )
            ),
            array(
                'id'          => 'widget_area',
                'label'       => __('Widget Area', ETHEME_DOMAIN),
                'type'        => 'sidebar_select'
            ),
            array(
                'id'          => 'sidebar_width',
                'label'       => __('Sidebar width', ETHEME_DOMAIN),
                'type'        => 'select',
                'choices'     => array(
                      array( 
                        'value' => '',
                        'label' => 'Default' 
                      ),
                      array( 
                        'value' => 2,
                        'label' => '1/6' 
                      ),
                      array( 
                        'value' => 3,
                        'label' => '1/4' 
                      ),
                      array( 
                        'value' => 4,
                        'label' => '1/3' 
                      )
                    )
            ),
            array(
                'id'          => 'page_heading',
                'label'       => __('Show Page Heading', ETHEME_DOMAIN),
                'type'        => 'select',
                'choices'     => array(
                      array( 
                        'value' => 'enable',
                        'label' => 'Enable' 
                      ),
                      array( 
                        'value' => 'disable',
                        'label' => 'Disable' 
                      )
                    )
            )
            
        );
    
        if(class_exists('RevSliderAdmin')) {
        	
        	$rs = $wpdb->get_results( 
        		"
        		SELECT id, title, alias
        		FROM ".$wpdb->prefix."revslider_sliders
        		ORDER BY id ASC LIMIT 100
        		"
        	);
        	$revsliders = array(array(
        		'value' => 'no_slider',
        		'label' => 'No Slider'
        	));
        	if ($rs) {
        	$_ri = 1;
        	foreach ( $rs as $slider ) {
        	  	$revsliders[$_ri]['value'] = $slider->alias;
        	  	$revsliders[$_ri]['label'] = $slider->title;
        		$_ri++;
        	}
        	} else {
        		$revsliders["No sliders found"] = 0;
        	}
        	
    
            if(count($revsliders)>0 ){
        	    array_push($page_options, array(
                    'id'          => 'page_slider',
                    'label'       => 'Show revolution slider instead of breadcrumbs and page title',
                    'type'        => 'select',
                    'choices'     => $revsliders
                ));
            }
        }
    
      $my_meta_box = array(
        'id'        => 'page_layout',
        'title'     => 'Page Layout',
        'desc'      => '',
        'pages'     => array( 'page', 'post' ),
        'context'   => 'side',//side normal
        'priority'  => 'low',
        'fields'    => $page_options
      );
      
      ot_register_meta_box( $my_meta_box ); 
    
    }
    
    
    /**
     * Initialize the meta boxes for products. 
     */
    add_action( 'admin_init', 'products_meta_boxes' );
    
    
    function products_meta_boxes() {
    	$statick_blocks = array();
    	$statick_blocks[] = array("label"=>"--choose--","value"=>"");
    	$statick_blocks = array_merge($statick_blocks, et_get_static_blocks());
    	
        $page_options = array(
            array(
                'id'          => 'additional_block',
                'label'       => 'Additional information block',
                'type'        => 'select',
                'choices'     => $statick_blocks
            ),
            array(
                'id'          => 'product_new',
                'label'       => 'Mark product as "New"',
                'type'        => 'select',
                'choices'     => array(
                  array( 
                    'value' => 'disable',
                    'label' => 'Choose' 
                  ),
                  array( 
                    'value' => 'disable',
                    'label' => 'No' 
                  ),
                  array( 
                    'value' => 'enable',
                    'label' => 'Yes' 
                  )
                )
            ),
    
            array(
                'id'          => 'size_guide_img',
                'label'       => 'Size Guide img',
                'desc'        => 'Upload image: png, jpg or gif file',
                'type'        => 'upload'
            ),
            array(
                'id'          => 'hover_img',
                'label'       => 'Upload image for hover effect',
                'type'        => 'upload'
            ),
            array(
                'id'          => 'custom_tab1_title',
                'label'       => 'Title for custom tab',
                'type'        => 'text'
            ),
            array(
                'id'          => 'custom_tab1',
                'label'       => 'Text for custom tab',
                'type'        => 'textarea'
            ),
        );
    
      $my_meta_box = array(
        'id'        => 'product_options',
        'title'     => 'Additional product options [8theme]',
        'desc'      => '',
        'pages'     => array( 'product' ),
        'context'   => 'normal',//side normal
        'priority'  => 'low',
        'fields'    => $page_options
      );
      
      ot_register_meta_box( $my_meta_box ); 
    
    }
    
    /**
     * Initialize the meta boxes for portfolio. 
     */
    //add_action( 'admin_init', 'portfolio_meta_boxes' );
    
    
    function portfolio_meta_boxes() {
        $page_options = array(
            array(
                'id'          => 'project_url',
                'label'       => 'Project Url',
                'type'        => 'text'
            ),
            array(
                'id'          => 'client',
                'label'       => 'Client',
                'type'        => 'text'
            ),
            array(
                'id'          => 'client_url',
                'label'       => 'Client Url',
                'type'        => 'text'
            ),
            array(
                'id'          => 'copyright',
                'label'       => 'Copyright',
                'type'        => 'text'
            ),
            array(
                'id'          => 'copyright_url',
                'label'       => 'Copyright Url',
                'type'        => 'text'
            ),
        );
    
      $my_meta_box = array(
        'id'        => 'product_options',
        'title'     => 'Additional project information',
        'desc'      => '',
        'pages'     => array( 'etheme_portfolio' ),
        'context'   => 'normal',//side normal
        'priority'  => 'low',
        'fields'    => $page_options
      );
      
      ot_register_meta_box( $my_meta_box ); 
    
    }
    
    
    	  
    function etheme_theme_settings_defaults() {
    	$defaults = array();
    	return apply_filters('etheme_theme_settings_defaults', $defaults);
    }
}
?>