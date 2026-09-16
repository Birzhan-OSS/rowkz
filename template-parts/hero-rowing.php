<?php
/**
 * Анимированный фон главной: одиночка на рассвете (SVG + SMIL).
 * При prefers-reduced-motion анимация ставится на паузу.
 *
 * @package rowkz
 */
?>
<svg class="rk-rowing" viewBox="0 0 1600 720" preserveAspectRatio="xMidYMid slice" aria-hidden="true" focusable="false">
	<defs>
		<linearGradient id="rkSky" x1="0" y1="0" x2="0" y2="1">
			<stop offset="0" stop-color="#0b1a28"/>
			<stop offset=".55" stop-color="#16395a"/>
			<stop offset="1" stop-color="#2c6f93"/>
		</linearGradient>
		<linearGradient id="rkWater" x1="0" y1="0" x2="0" y2="1">
			<stop offset="0" stop-color="#1f5a7c"/>
			<stop offset="1" stop-color="#0c2233"/>
		</linearGradient>
		<radialGradient id="rkSun" cx="0.5" cy="0.5" r="0.5">
			<stop offset="0" stop-color="#ffe7b8" stop-opacity=".95"/>
			<stop offset=".35" stop-color="#f7c989" stop-opacity=".45"/>
			<stop offset="1" stop-color="#f7c989" stop-opacity="0"/>
		</radialGradient>
		<linearGradient id="rkGlare" x1="0" y1="0" x2="0" y2="1">
			<stop offset="0" stop-color="#ffe2ad" stop-opacity=".55"/>
			<stop offset="1" stop-color="#ffe2ad" stop-opacity="0"/>
		</linearGradient>
	</defs>

	<!-- небо и солнце -->
	<rect width="1600" height="720" fill="url(#rkSky)"/>
	<circle cx="1380" cy="430" r="300" fill="url(#rkSun)"/>
	<circle cx="1380" cy="442" r="44" fill="#ffe9c4" opacity=".92"/>

	<!-- дальний берег -->
	<path d="M0 452 C 160 430 300 438 440 446 S 760 424 920 440 1240 428 1400 442 1560 436 1600 440 L1600 470 L0 470 Z" fill="#0d2536" opacity=".85"/>

	<!-- вода -->
	<rect y="468" width="1600" height="252" fill="url(#rkWater)"/>
	<g stroke="#ffe2ad" stroke-linecap="round">
		<line x1="1343" y1="482" x2="1413" y2="482" stroke-width="2.0" opacity="0.55"><animate attributeName="opacity" values="0.55;0.17;0.55" dur="1.60s" repeatCount="indefinite"/></line>
		<line x1="1327" y1="494" x2="1417" y2="494" stroke-width="2.4" opacity="0.45"><animate attributeName="opacity" values="0.45;0.14;0.45" dur="1.97s" repeatCount="indefinite"/></line>
		<line x1="1350" y1="508" x2="1410" y2="508" stroke-width="2.8" opacity="0.4"><animate attributeName="opacity" values="0.4;0.12;0.4" dur="2.34s" repeatCount="indefinite"/></line>
		<line x1="1333" y1="524" x2="1443" y2="524" stroke-width="3.2" opacity="0.32"><animate attributeName="opacity" values="0.32;0.10;0.32" dur="2.71s" repeatCount="indefinite"/></line>
		<line x1="1329" y1="542" x2="1409" y2="542" stroke-width="3.6" opacity="0.26"><animate attributeName="opacity" values="0.26;0.08;0.26" dur="3.08s" repeatCount="indefinite"/></line>
		<line x1="1305" y1="566" x2="1435" y2="566" stroke-width="4.0" opacity="0.2"><animate attributeName="opacity" values="0.2;0.06;0.2" dur="3.45s" repeatCount="indefinite"/></line>
		<line x1="1335" y1="596" x2="1435" y2="596" stroke-width="4.4" opacity="0.15"><animate attributeName="opacity" values="0.15;0.04;0.15" dur="3.82s" repeatCount="indefinite"/></line>
		<line x1="1291" y1="630" x2="1451" y2="630" stroke-width="4.8" opacity="0.1"><animate attributeName="opacity" values="0.1;0.03;0.1" dur="4.19s" repeatCount="indefinite"/></line>
	</g>

	<!-- волны: три слоя с разной скоростью -->
	<g opacity=".35">
		<path d="M0 500 q50 -8 100 0 t100 0 t100 0 t100 0 t100 0 t100 0 t100 0 t100 0 t100 0 t100 0 t100 0 t100 0 t100 0 t100 0 t100 0 t100 0 t100 0 t100 0 t100 0 t100 0 t100 0 t100 0 t100 0 t100 0 t100 0 t100 0 t100 0 t100 0 t100 0 t100 0 t100 0 t100 0" fill="none" stroke="#9fd0e6" stroke-width="1.5">
			<animateTransform attributeName="transform" type="translate" from="0 0" to="-200 0" dur="9s" repeatCount="indefinite"/>
		</path>
	</g>
	<g opacity=".25">
		<path d="M0 560 q70 -10 140 0 t140 0 t140 0 t140 0 t140 0 t140 0 t140 0 t140 0 t140 0 t140 0 t140 0 t140 0 t140 0 t140 0 t140 0 t140 0 t140 0 t140 0 t140 0 t140 0 t140 0 t140 0 t140 0 t140 0" fill="none" stroke="#9fd0e6" stroke-width="2">
			<animateTransform attributeName="transform" type="translate" from="0 0" to="-280 0" dur="7s" repeatCount="indefinite"/>
		</path>
	</g>
	<g opacity=".18">
		<path d="M0 640 q100 -14 200 0 t200 0 t200 0 t200 0 t200 0 t200 0 t200 0 t200 0 t200 0 t200 0 t200 0 t200 0 t200 0 t200 0 t200 0 t200 0 t200 0 t200 0 t200 0" fill="none" stroke="#9fd0e6" stroke-width="3">
			<animateTransform attributeName="transform" type="translate" from="0 0" to="-400 0" dur="5s" repeatCount="indefinite"/>
		</path>
	</g>

	<!-- буйки дорожки: создают ощущение движения лодки вперёд -->
	<g fill="#f2b705" opacity=".75">
		<g>
			<?php for ( $x = 0; $x <= 1760; $x += 80 ) : ?>
				<ellipse cx="<?php echo (int) $x; ?>" cy="596" rx="5" ry="3"/>
			<?php endfor; ?>
			<animateTransform attributeName="transform" type="translate" from="0 0" to="-80 0" dur="1.2s" repeatCount="indefinite"/>
		</g>
	</g>

	<!-- одиночка: нос справа, гребец смотрит к корме; вёсла — гребок под водой, возврат над водой -->
	<g transform="translate(1150 540) scale(1.15)">
		<g>
			<animateTransform attributeName="transform" type="translate" values="0 0; 0 -2; 0 -2; 0 0; 0 0" keyTimes="0; .35; .42; .93; 1" dur="2.4s" repeatCount="indefinite" calcMode="spline" keySplines=".45 0 .25 1; .3 0 .7 1; .45 0 .35 1; .3 0 .7 1"/>

			<!-- кильватерный след -->
			<g stroke="#cfe8f3" stroke-linecap="round" fill="none">
				<path d="M-270 6 H-400" stroke-width="2" opacity=".45"><animate attributeName="opacity" values=".45;.15;.45" dur="2.4s" repeatCount="indefinite"/></path>
				<path d="M-300 12 H-470" stroke-width="1.5" opacity=".3"><animate attributeName="opacity" values=".15;.35;.15" dur="2.4s" repeatCount="indefinite"/></path>
			</g>
			<ellipse cx="10" cy="14" rx="280" ry="6" fill="#06131d" opacity=".35"/>

			<!-- дальнее весло -->
			<g opacity=".5">
				<polyline fill="none" stroke="#0c2233" stroke-width="3.5" stroke-linecap="round" points="-38,-32 112,2"><animate attributeName="points" values="-38,-32 112,2; 30,-38 -92,2; 30,-38 -92,-14; -38,-32 112,-14; -38,-32 112,2" keyTimes="0; .35; .42; .93; 1" dur="2.4s" repeatCount="indefinite" calcMode="spline" keySplines=".45 0 .25 1; .3 0 .7 1; .45 0 .35 1; .3 0 .7 1"/></polyline>
				<ellipse rx="20" ry="6" fill="#0c2233" cx="112" cy="2"><animate attributeName="cx" values="112;-92;-92;112;112" keyTimes="0; .35; .42; .93; 1" dur="2.4s" repeatCount="indefinite" calcMode="spline" keySplines=".45 0 .25 1; .3 0 .7 1; .45 0 .35 1; .3 0 .7 1"/><animate attributeName="cy" values="2;2;-14;-14;2" keyTimes="0; .35; .42; .93; 1" dur="2.4s" repeatCount="indefinite" calcMode="spline" keySplines=".45 0 .25 1; .3 0 .7 1; .45 0 .35 1; .3 0 .7 1"/></ellipse>
			</g>

			<!-- корпус (нос справа) -->
			<path d="M-270 0 C -180 -5 200 -9 310 -2 C 200 5 -180 8 -270 0 Z" fill="#f4f1ea"/>
			<path d="M-270 0 C -180 3 200 3 310 -2" fill="none" stroke="#1d6f93" stroke-width="3"/>
			<path d="M-10 -4 L-4 -28" stroke="#c9d3da" stroke-width="3" stroke-linecap="round"/>

			<!-- гребец -->
			<g fill="none" stroke="#0c2233" stroke-linecap="round" stroke-linejoin="round">
				<polyline stroke-width="10" points="-64,-14 -30,-46 -20,-14 -44,-62"><animate attributeName="points" values="-64,-14 -30,-46 -20,-14 -44,-62; -64,-14 -10,-18 20,-14 36,-66; -64,-14 -10,-18 20,-14 36,-66; -64,-14 -30,-46 -20,-14 -44,-62; -64,-14 -30,-46 -20,-14 -44,-62" keyTimes="0; .35; .42; .93; 1" dur="2.4s" repeatCount="indefinite" calcMode="spline" keySplines=".45 0 .25 1; .3 0 .7 1; .45 0 .35 1; .3 0 .7 1"/></polyline>
				<polyline stroke-width="6" points="-44,-62 -42,-30"><animate attributeName="points" values="-44,-62 -42,-30; 36,-66 26,-36; 36,-66 26,-36; -44,-62 -42,-30; -44,-62 -42,-30" keyTimes="0; .35; .42; .93; 1" dur="2.4s" repeatCount="indefinite" calcMode="spline" keySplines=".45 0 .25 1; .3 0 .7 1; .45 0 .35 1; .3 0 .7 1"/></polyline>
			</g>
			<circle r="11" fill="#0c2233" cx="-50" cy="-78"><animate attributeName="cx" values="-50;42;42;-50;-50" keyTimes="0; .35; .42; .93; 1" dur="2.4s" repeatCount="indefinite" calcMode="spline" keySplines=".45 0 .25 1; .3 0 .7 1; .45 0 .35 1; .3 0 .7 1"/><animate attributeName="cy" values="-78;-82;-82;-78;-78" keyTimes="0; .35; .42; .93; 1" dur="2.4s" repeatCount="indefinite" calcMode="spline" keySplines=".45 0 .25 1; .3 0 .7 1; .45 0 .35 1; .3 0 .7 1"/></circle>

			<!-- ближнее весло -->
			<polyline fill="none" stroke="#081723" stroke-width="4.5" stroke-linecap="round" points="-42,-30 108,6"><animate attributeName="points" values="-42,-30 108,6; 26,-36 -96,6; 26,-36 -96,-10; -42,-30 108,-10; -42,-30 108,6" keyTimes="0; .35; .42; .93; 1" dur="2.4s" repeatCount="indefinite" calcMode="spline" keySplines=".45 0 .25 1; .3 0 .7 1; .45 0 .35 1; .3 0 .7 1"/></polyline>
			<ellipse rx="22" ry="7" fill="#f2b705" cx="108" cy="6"><animate attributeName="cx" values="108;-96;-96;108;108" keyTimes="0; .35; .42; .93; 1" dur="2.4s" repeatCount="indefinite" calcMode="spline" keySplines=".45 0 .25 1; .3 0 .7 1; .45 0 .35 1; .3 0 .7 1"/><animate attributeName="cy" values="6;6;-10;-10;6" keyTimes="0; .35; .42; .93; 1" dur="2.4s" repeatCount="indefinite" calcMode="spline" keySplines=".45 0 .25 1; .3 0 .7 1; .45 0 .35 1; .3 0 .7 1"/></ellipse>

			<!-- брызги при захвате -->
			<circle cx="108" cy="8" r="4" fill="none" stroke="#dff1f8" stroke-width="2" opacity="0">
				<animate attributeName="r" values="4;4;26;26" keyTimes="0;.93;.99;1" dur="2.4s" repeatCount="indefinite"/>
				<animate attributeName="opacity" values="0;.8;0;0" keyTimes="0;.93;.99;1" dur="2.4s" repeatCount="indefinite"/>
			</circle>
		</g>
	</g>
</svg>
<script>
(function () {
	var svg = document.querySelector('.rk-rowing');
	if (!svg || !window.matchMedia) return;
	var mq = window.matchMedia('(prefers-reduced-motion: reduce)');
	var apply = function () { if (mq.matches && svg.pauseAnimations) { svg.pauseAnimations(); } else if (svg.unpauseAnimations) { svg.unpauseAnimations(); } };
	apply();
	if (mq.addEventListener) { mq.addEventListener('change', apply); }
})();
</script>
